<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../">
    <link rel="icon" href="{{setting('media','white_fav_icon.url')}}" type="image/x-icon"/>
    <title>@yield('title') | {{setting('general','name.'.get_current_lang())}}</title>

    <meta charset="utf-8"/>
    <link rel="canonical" href="{{url('/')}}"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("dashboard/css/style.bundle.css")}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->

<!--begin::Body-->
<body data-kt-name="metronic" id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
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
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('{{asset("dashboard/media/auth/bg7.jpg")}}');
        }

        [data-theme="dark"] body {
            background-image: url('{{asset("dashboard/media/auth/bg7-dark.jpg")}}');
        }
    </style>

    <!--end::Page bg image-->
    <!--begin::Authentication - Signup Welcome Message -->
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center text-center p-10">
            <!--begin::Wrapper-->
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">


                @yield('error')

                <!--begin::Illustration-->
                    <div class="mb-3">
                        <img src="{{asset("dashboard/media/auth/{$code}-error.png")}}" class="mw-100 mh-300px theme-light-show" alt=""/>
                        <img src="{{asset("dashboard/media/auth/{$code}-error-dark.png")}}" class="mw-100 mh-300px theme-dark-show" alt=""/>
                    </div>
                    <!--end::Illustration-->
                    <!--begin::Link-->
                    <div class="mb-0">
                        <a class="btn btn-sm btn-primary" href="{{route('frontend.home')}}">{{t_('Return Home')}}</a>
                    </div>
                    <!--end::Link-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Signup Welcome Message-->
</div>
<!--end::Root-->

<!--begin::Javascript-->
<script>var hostUrl = "dashboard/";</script>

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset("dashboard/plugins/global/plugins.bundle.js")}}"></script>
<script src="{{asset("dashboard/js/scripts.bundle.js")}}"></script>
<!--end::Global Javascript Bundle-->

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>

