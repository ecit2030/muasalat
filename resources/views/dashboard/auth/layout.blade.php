<!DOCTYPE html>


<html direction="{{session('language.direction')}}" dir="{{session('language.direction')}}" style="direction: {{session('language.direction')}}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}"><!--begin::Head-->

@include('dashboard.layouts.includes.head')

<!--end::Head-->
<!--begin::Body-->
<body data-kt-name="metronic" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
      data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
      data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" dir="{{session('language.direction')}}" data-kt-app-toolbar-enabled="true"
      data-kt-app-toolbar-fixed="true" class="app-default" {!! $attributes ?? "" !!}>

<!--begin::Theme mode setup on page load-->
<script>if (document.documentElement) {
        const defaultThemeMode = "system";
        const name = document.body.getAttribute("data-kt-name");
        let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
        if (themeMode === null) {
            if (defaultThemeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            } else {
                themeMode = defaultThemeMode;
            }
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->

        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            @yield('content')
        </div>

        <style>
            body {
                background-image: url('{{asset('dashboard/media/auth/bg10.jpeg')}}');
            }

            [data-theme="dark"] body {
                background-image: url('{{asset('assets/media/auth/bg10-dark.jpeg')}}');
            }
        </style>

        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url({{asset('dashboard/media/misc/auth-bg.png')}})">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->

                <!--end::Logo-->
                <!--begin::Image-->
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{setting('media','login_page_background.url',asset('dashboard/media/auth/agency.png'))}}"
                     alt=""/>
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{setting('media','login_page_background.url',asset('dashboard/media/auth/agency-dark.png'))}}"
                     alt=""/>                <!--end::Image-->
                <!--begin::Title-->
                <h1 class=" theme-light-show text-muted fs-2qx fw-bolder text-center mb-7">{{t_('dashboard login description')}}</h1>
                <!--end::Title-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "dashboard/";</script>

<script>
    var translations = {!! file_exists(lang_path('/').get_current_lang().'.json') ? file_get_contents(lang_path('/').get_current_lang().'.json')  : "" !!};

    function trans(Key) {
        var key = Key.toLowerCase();
        // var trans = JSON.parse(translations);
        return (translations[key] != null ? translations[key] : key);
    }
</script>


<!--begin::Global Javascript Bundle(used by all pages)-->

<script src="{{asset('dashboard/plugins/global/plugins.bundle.js')}}"></script>

<script src="{{asset('dashboard/js/scripts.bundle.js')}}"></script>

<!--end::Global Javascript Bundle-->

<!--begin::Custom Javascript(used by this page)-->

<script src="{{asset('dashboard/js/custom/authentication/sign-in/general.js')}}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>