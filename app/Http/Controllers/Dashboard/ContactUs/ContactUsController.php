<?php

namespace App\Http\Controllers\Dashboard\ContactUs;

use App\Datatables\Dashboard\ContactUs\ContactUsDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\ContactUs\ReplyRequest;
use App\Models\ContactUs;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Arr;
use Illuminate\Database\Eloquent\Model;
use Mail;
use Modules\Code\Emails\SendReply;

class ContactUsController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.general.contact-us';
    protected string $viewPath  = 'dashboard.general.contact-us';

    protected string $datatable = ContactUsDatatable::class;

    protected string $permissions = 'contact_us';

    protected string $model = ContactUs::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $ContactUs = $this->model::findOrFail($id);

        return view($this->routeName . '.show', compact('ContactUs'));
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

    public function reply(ReplyRequest $request )
    {
        $contactUs = ContactUs::findOrFail($request->contact_us_id);
        try {
            Mail::to($contactUs->email)->send(new SendReply($contactUs->name, $request->reply));
            $contactUs->update([
                "is_replied" => true ,
                "reply" => $request->reply ,
            ]);
        } catch (\Throwable $th) {
            info($th->getMessage());
        }

        return redirect()->route("dashboard.general.contact-us.show" , ["contact_u" => $request->contact_us_id] ) ;
    }


    protected function formData(?Model $model = null): array
    {
        return [
            "model" => $model
        ];

    }
}
