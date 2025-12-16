<!DOCTYPE html>


<!--begin::Head-->

<html direction="{{session('language.direction')}}" dir="{{session('language.direction')}}" style="direction: {{session('language.direction')}}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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


<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <x-navbar.navbar/>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::sidebar-->
            <x-sidebar :modules="$sidebar"/>
            <!--end::sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">

                @include('dashboard.layouts.includes.toolbar')

                <!--begin::Content-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            @yield('content')

                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                    <!--begin::Footer container-->
                    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2022©</span>
                            <a href="{{url('/')}}" target="_blank" class="text-gray-800 text-hover-primary">
                                {{data_get($general,"copyright.{$session_get('language.code')}")}}
                            </a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="https://moltaqa.net/about" target="_blank" class="menu-link px-2">{{t_("about us")}}</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://moltaqa.net/contact" target="_blank" class="menu-link px-2">{{t_("support")}}</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://moltaqa.net/services" target="_blank" class="menu-link px-2">{{t_('Purchase')}}</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Footer container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->

@include('dashboard.layouts.includes.scripts')

</body>
<!--end::Body-->
</html>
