<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Notification\StoreNotificationRequest;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Datatables\Dashboard\Notification\NotificationDatatable;
use App\Http\Resources\WebJsonResource;
use App\Models\Notification;
use App\Support\Crud\WithCrud;
use App\Support\Crud\WithDatatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NotificationController extends DashboardController
{
    use WithDatatable, WithCrud;

    protected string $routeName = 'dashboard.notifications.notifications';
    protected string $viewPath = 'dashboard.notifications.notifications';

    protected string $permissions = 'notification';
    protected string $datatable = NotificationDatatable::class;
    protected string $model = Notification::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $model = $this->model::whereId($id)->first();

        if (auth()->id() == $model->notifiable_id) {
            $model->read_at = Carbon::now();
            $model->save();
        }

        $receviers = $this->model::where("data->title", $model->data["title"])->where("data->message", $model->data["message"])->get("notifiable_id")->pluck("notifiable_id");

        $receivers = User::whereIn("id", $receviers)->with("roles:name")->get(["id", "name"])->map(function ($q) {
            return ["id" => $q->id, "name" => $q->name, "role" => $q->roles[0]?->name];
        })->groupBy("role");

        return view($this->routeName . '.show', get_defined_vars());
    }


    public function index()
    {
        auth()->user()->notifications->markAsRead();
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'isAdmin' => auth()->user()->can('create_' . $this->permissions),
            'title' => "",
        ]);
    }

    protected function store(StoreNotificationRequest $request)
    {
        if (is_array($request->receivers) && !empty($request->receivers)) {
            if(!in_array(0,$request->receivers)){
                $receivers = User::withWhereHas('deviceTokens')->select("id")->whereIn("id", $request->receivers)->get();
            }
            else{
                $receivers = $this->ajaxGetReceivers($request->receiver_types);
                $receivers = User::withWhereHas('deviceTokens')->select("id")->whereIn("id", collect($receivers)->pluck("id"))->get();
            }
        } else {
            $receivers = $this->ajaxGetReceivers($request->receiver_types);
            $receivers = User::withWhereHas('deviceTokens')->select("id")->whereIn("id", collect($receivers)->pluck("id"))->get();
        }
        if ($receivers->isNotEmpty()) {
            foreach ($receivers as $receiver) {
                $tokens = $receiver->sendableTokens;
                $receiver->notify(new FcmNotification($tokens, $request->title, $request->message));
            }
        }

        return redirect()->route("dashboard.notifications.notifications.index");
    }

    protected function ajaxGetReceivers($roles = [])
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");
        $role = request("receiver_types") ?? $roles;
        $moderators = [];
        $drivers = [];
        $users = [];

        if ($admin) {
            $data = User::withWhereHas('deviceTokens')->whereNotIn("id", [1, auth()->id()])->select("id", "name")->role($role)->whereIsActive(true)->get()->toArray();
        } elseif ($organization) {

            if (is_numeric(array_search("moderator", $role))) {
                $moderators = User::withWhereHas('deviceTokens')->role("moderator")->select("id", "name")->whereOrganizationId(auth()->id())->get()->toArray();
            }

            if (is_numeric(array_search("driver", $role))) {
                $drivers = User::withWhereHas('deviceTokens')->role("driver")->select("id", "name")->whereOrganizationId(auth()->id())->get()->toArray();
            }

            if (is_numeric(array_search("user", $role))) {
                $users = User::withWhereHas('deviceTokens')->role("user")->select("id", "name")->get()->toArray();
            }

            $data = [...$moderators, ...$drivers, ...$users];
        } elseif ($moderator) {

            if (is_numeric(array_search("moderator", $role))) {
                $moderators = User::withWhereHas('deviceTokens')->whereNotIn("id", [auth()->id()])->role("moderator")->select("id", "name")->whereOrganizationId(auth()->id())->get()->toArray();
            }
            if (is_numeric(array_search("driver", $role))) {
                $drivers = User::withWhereHas('deviceTokens')->role("driver")->select("id", "name")->whereOrganizationId(auth()->user()->organization_id)->get()->toArray();
            }

            if (is_numeric(array_search("user", $role))) {
                $users = User::withWhereHas('deviceTokens')->role("user")->select("id", "name")->get()->toArray();
            }

            $data = [...$moderators, ...$drivers, ...$users];
        }

        if ($roles == []) {
            return WebJsonResource::collection($data);
        } else {
            return $data;
        }
    }

    protected function formData(?Model $model = null): array
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $receiver_types = ["admin" => t_("admins"), "captain" => t_("captain"), "organization" => t_("organization"), "driver" => t_("driver"), "user" => t_("user")];
        } elseif ($organization) {
            $receiver_types = ["driver" => t_("driver"), "user" => t_("user"), "moderator" => t_("moderator")];
        } elseif ($moderator) {
            $receiver_types = ["driver" => t_("driver"), "user" => t_("user")];
        }

        return [
            "receiver_types" => $receiver_types,
        ];
    }
}
