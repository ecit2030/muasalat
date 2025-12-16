<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Toolbar start-->
        <div class="d-flex align-items-center me-5">
            <!--begin::Input group-->
            <div class="d-flex align-items-center flex-shrink-0">
                <!--begin::Label-->
                <!--end::Label-->
                <!--begin::Actions-->
                <div class="d-flex flex-shrink-0">

                    @yield('filters')
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex align-items-center flex-shrink-0">
                <!--begin::Desktop separartor-->
                @yield('after_actions')
            <!--end::Desktop separartor-->
            </div>
            <!--end::Input group-->
        </div>

        <!--end::Toolbar start-->
        <!--begin::Toolbar end-->
        <div class="d-flex align-items-center">
            @yield('actions')
        </div>
        <!--end::Toolbar end-->
    </div>
    <!--end::Toolbar container-->
</div>