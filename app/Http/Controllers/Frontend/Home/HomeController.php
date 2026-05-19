<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\ContactUs;
use App\Models\JoinRequest;
use App\Models\Trip;
use App\Models\User;
use App\Rules\UniqueCommercialNumber;
use App\Rules\UniquePersonalId;
use App\Rules\UniquqIban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\StaticPage\Entities\StaticPage;

class HomeController extends FrontendController
{
    public function index(Request $request)
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        // if ($admin) {
        //     $data = Track::query()->latest();
        // } elseif ($organization) {
        //     $data = Track::query()->whereOwnerId(auth()->id())->latest();
        // } elseif ($moderator) {
        //     $data = Track::query()->whereOwnerId(auth()->user()->organization_id)->latest();
        // }
        $isOrganization = auth()->user()?->hasRole("organization");

        $loaders = [
            [
                "title" => "users",
                "color" => "blue",
                "count" => User::when($isOrganization, function ($q) {
                    $q->whereHas('roles', function ($q) {
                        $q->where('owner_id', auth()->id());
                    });
                })->when(!$isOrganization, function ($q) {
                    $q->role("user");
                })->count()
            ],
            [
                "title" => "captain",
                "color" => "yellow",
                "count" => User::role("captain")->when($isOrganization, function ($q) {
                    $q->where('organization_id', auth()->id());
                })->count()
            ],
            [
                "title" => "all trips",
                "color" => "green",
                "count" => Trip::when($isOrganization, function ($q) {
                    $q->whereHas('driver', function ($q) {
                        $q->where('organization_id', auth()->id());
                    });
                })->count()
            ],
            [
                "title" => "finished trips",
                "color" => "purpel",
                "count" => Trip::when($isOrganization, function ($q) {
                    $q->whereHas('driver', function ($q) {
                        $q->where('organization_id', auth()->id());
                    });
                })->whereNotNull("end_at")->count()
            ],
            [
                "title" => "current trips",
                "color" => "red",
                "count" => Trip::when($isOrganization, function ($q) {
                    $q->whereHas('driver', function ($q) {
                        $q->where('organization_id', auth()->id());
                    });
                })->whereNotNull("start_at")->whereNull("end_at")->count()
            ],
        ];
        if (!$isOrganization) {
            array_unshift($loaders, [
                "title" => "contactus",
                "color" => "grey",
                "count" => ContactUs::count()
            ]);
        }

        $loaders = json_decode(json_encode($loaders), FALSE);

        if (activeGuard()) {
            return view("dashboard.home", compact("loaders"));
        }
        return redirect()->route("dashboard.login");

    }

    public function landing(Request $request)
    {
        //$staticpages = StaticPage::all();
        $staticpages = StaticPage::orderBy('id', 'asc')->take(3)->get();

        return view("Site.index", get_defined_vars());
    }


    public function contactUsLanding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|max:10|min:10|starts_with:05',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errorss = $validator->errors()->all();
            //$staticpages = StaticPage::all();
            $staticpages = StaticPage::orderBy('id', 'asc')->take(3)->get();
            return view("Site.index", get_defined_vars());
        };

        ContactUs::create($validator->validated());
        return redirect()->route("frontend.home");
    }


    public function postOrg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone',

            'organization_name' => 'required|string|max:100|unique:users,organization_name',
            'organization_commercial_number' => ['required', 'numeric', new UniqueCommercialNumber],
            'logo' => 'required|image|mimes:png,jpeg,gif|max:5000',
            'avatar' => 'required|image|mimes:png,jpeg,gif|max:5000',

            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',

            "bank_name" => "required|string|max:100",
            "bank_personal_id" => ["required", "numeric", new UniquePersonalId],
            "iban" => ["required", "string", new UniquqIban]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $model = JoinRequest::create($validator->validated());
        uploadMedia('avatar', $validator->validated()["avatar"], $model);
        uploadMedia('logo', $validator->validated()["logo"], $model);

        session()->put("success", t_('Request executed successfully'));
        return redirect()->route("frontend.home");
    }

    public function getOrg()
    {
        return view("Site.orgForm");
    }

}
