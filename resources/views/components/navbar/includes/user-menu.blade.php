@aware(['user'=>auth(activeGuard())->user(),'currentLanguage'])

<!--begin::User menu-->
<div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
         data-kt-menu-placement="bottom-end">
        <img src="{{data_get($user,'avatar')}}" alt="user"/>
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
         data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{data_get($user,'avatar')}}"/>
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">{{data_get($user,'name')}}
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{data_get($user,'info.language_code')}}</span></div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{data_get($user,'email')}}</a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            @if (activeGuard('dashboard'))
                <a href="{{route("dashboard.general.administration.profile.index")}}" class="menu-link px-5">{{t_("my profile")}}</a>
            @endif
        </div>
        <!--end::Menu item-->


        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->


        {{-- LANGUAGE  --}}

        <!--begin::Menu item-->
         <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
             data-kt-menu-placement="left-start">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">{{t_('language')}}
                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ $currentLanguage?->name }}
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset($currentLanguage?->flag ?? ($language->code == 'ar' ? asset('dashboard/media/flags/saudi-arabia.svg') : asset('dashboard/media/flags/united-states.svg'))) }}"
                             alt=""/></span></span>
            </a>
            <!--begin::Menu sub-->
            <div class="menu-sub menu-sub-dropdown w-175px py-4">

            @foreach ($languages as $language)
                <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="{{ route('dashboard.lang', $language->code) }}"
                           class="menu-link d-flex px-5 {{$language->id ==$currentLanguage?->id ? 'active':''}}">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset($language->flag ?? ($language->code == 'ar' ? asset('dashboard/media/flags/saudi-arabia.svg') : asset('dashboard/media/flags/united-states.svg')))  }}" alt=""/>
                            </span>{{ $language->name }}</a>
                    </div>
                    <!--end::Menu item-->
                @endforeach


            </div>
            <!--end::Menu sub-->
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item-->
        <div class="menu-item px-5">

            {{-- @if(activeGuard()) --}}
            <a class="menu-link px-5" href="{{ route(activeGuard().'.logout') }}">{{ t_('Sign Out') }}</a>
            {{-- @endif --}}

        </div>
        <!--end::Menu item-->
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::User menu-->
