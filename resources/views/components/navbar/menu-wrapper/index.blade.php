@props(['modules'=>[]])
{{--

<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
     data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="225px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
     data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
     data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
    <!--begin::Menu-->
    <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
         id="kt_app_header_menu" data-kt-menu="true">
--}}
{{--

        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
             class="menu-item menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Pages</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                <!--begin:Pages menu-->
                <div class="menu-active-bg px-4 px-lg-0">
                    <!--begin:Tabs nav-->
                    <div class="d-flex w-100 overflow-auto">
                        <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                            <!--begin:Nav item-->
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link py-3 py-lg-6 active text-active-primary" href="#" data-bs-toggle="tab"
                                   data-bs-target="#kt_app_header_menu_pages_pages">General</a>
                            </li>
                            <!--end:Nav item-->
                            <!--begin:Nav item-->
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab"
                                   data-bs-target="#kt_app_header_menu_pages_account">Account</a>
                            </li>
                            <!--end:Nav item-->
                            <!--begin:Nav item-->
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab"
                                   data-bs-target="#kt_app_header_menu_pages_authentication">Authentication</a>
                            </li>
                            <!--end:Nav item-->
                            <!--begin:Nav item-->
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab"
                                   data-bs-target="#kt_app_header_menu_pages_utilities">Utilities</a>
                            </li>
                            <!--end:Nav item-->
                            <!--begin:Nav item-->
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab"
                                   data-bs-target="#kt_app_header_menu_pages_widgets">Widgets</a>
                            </li>
                            <!--end:Nav item-->
                        </ul>
                    </div>
                    <!--end:Tabs nav-->

                    <!--begin:Tab content-->
                    <div class="tab-content py-4 py-lg-8 px-lg-7">
                        <!--begin:Tab pane-->
                        <div class="tab-pane active w-lg-1000px" id="kt_app_header_menu_pages_pages">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-8">
                                    <!--begin:Row-->
                                    <div class="row">
                                        <!--begin:Col-->
                                        <div class="col-lg-3 mb-6 mb-lg-0">
                                            <!--begin:Menu heading-->
                                            <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">User Profile</h4>
                                            <!--end:Menu heading-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/overview.html" class="menu-link">
                                                    <span class="menu-title">Overview</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/projects.html" class="menu-link">
                                                    <span class="menu-title">Projects</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/campaigns.html" class="menu-link">
                                                    <span class="menu-title">Campaigns</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/documents.html" class="menu-link">
                                                    <span class="menu-title">Documents</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/followers.html" class="menu-link">
                                                    <span class="menu-title">Followers</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/pages/user-profile/activity.html" class="menu-link">
                                                    <span class="menu-title">Activity</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-3 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-6">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Corporate</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/about.html" class="menu-link">
                                                        <span class="menu-title">About</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/team.html" class="menu-link">
                                                        <span class="menu-title">Our Team</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/contact.html" class="menu-link">
                                                        <span class="menu-title">Contact Us</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/licenses.html" class="menu-link">
                                                        <span class="menu-title">Licenses</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/sitemap.html" class="menu-link">
                                                        <span class="menu-title">Sitemap</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Careers</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/careers/list.html" class="menu-link">
                                                        <span class="menu-title">Careers List</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/careers/apply.html" class="menu-link">
                                                        <span class="menu-title">Careers Apply</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-3 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-6">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">FAQ</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/faq/classic.html" class="menu-link">
                                                        <span class="menu-title">FAQ Classic</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/faq/extended.html" class="menu-link">
                                                        <span class="menu-title">FAQ Extended</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                            <!--begin:Menu section-->
                                            <div class="mb-6">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Blog</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/blog/home.html" class="menu-link">
                                                        <span class="menu-title">Blog Home</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/blog/post.html" class="menu-link">
                                                        <span class="menu-title">Blog Post</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Pricing</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/pricing/column.html" class="menu-link">
                                                        <span class="menu-title">Column Pricing</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/pricing/table.html" class="menu-link">
                                                        <span class="menu-title">Table Pricing</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-3 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Social</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/social/feeds.html" class="menu-link">
                                                        <span class="menu-title">Feeds</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/social/activity.html" class="menu-link">
                                                        <span class="menu-title">Activty</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/social/followers.html" class="menu-link">
                                                        <span class="menu-title">Followers</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/pages/social/settings.html" class="menu-link">
                                                        <span class="menu-title">Settings</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                    </div>
                                    <!--end:Row-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-4">
                                    <img src="dashboard/media/stock/600x600/img-82.jpg" class="rounded mw-100" alt=""/>
                                </div>
                                <!--end:Col-->
                            </div>
                            <!--end:Row-->
                        </div>
                        <!--end:Tab pane-->
                        <!--begin:Tab pane-->
                        <div class="tab-pane w-lg-600px" id="kt_app_header_menu_pages_account">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-5 mb-6 mb-lg-0">
                                    <!--begin:Row-->
                                    <div class="row">
                                        <!--begin:Col-->
                                        <div class="col-lg-6">
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/overview.html" class="menu-link">
                                                    <span class="menu-title">Overview</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/settings.html" class="menu-link">
                                                    <span class="menu-title">Settings</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/security.html" class="menu-link">
                                                    <span class="menu-title">Security</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/activity.html" class="menu-link">
                                                    <span class="menu-title">Activity</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/billing.html" class="menu-link">
                                                    <span class="menu-title">Billing</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-6">
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/statements.html" class="menu-link">
                                                    <span class="menu-title">Statements</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/referrals.html" class="menu-link">
                                                    <span class="menu-title">Referrals</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/api-keys.html" class="menu-link">
                                                    <span class="menu-title">API Keys</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item p-0 m-0">
                                                <!--begin:Menu link-->
                                                <a href="../../demo1/dist/account/logs.html" class="menu-link">
                                                    <span class="menu-title">Logs</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Col-->
                                    </div>
                                    <!--end:Row-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-7">
                                    <img src="dashboard/media/stock/900x600/46.jpg" class="rounded mw-100" alt=""/>
                                </div>
                                <!--end:Col-->
                            </div>
                            <!--end:Row-->
                        </div>
                        <!--end:Tab pane-->
                        <!--begin:Tab pane-->
                        <div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_authentication">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-3 mb-6 mb-lg-0">
                                    <!--begin:Menu section-->
                                    <div class="mb-6">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Corporate Layout</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/corporate/sign-in.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-in</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-up</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/corporate/two-steps.html"
                                               class="menu-link">
                                                <span class="menu-title">Two-steps</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/corporate/reset-password.html"
                                               class="menu-link">
                                                <span class="menu-title">Reset Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/corporate/new-password.html"
                                               class="menu-link">
                                                <span class="menu-title">New Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                    <!--begin:Menu section-->
                                    <div class="mb-0">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Overlay Layout</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/overlay/sign-in.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-in</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/overlay/sign-up.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-up</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/overlay/two-steps.html"
                                               class="menu-link">
                                                <span class="menu-title">Two-steps</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/overlay/reset-password.html"
                                               class="menu-link">
                                                <span class="menu-title">Reset Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/overlay/new-password.html"
                                               class="menu-link">
                                                <span class="menu-title">New Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-3 mb-6 mb-lg-0">
                                    <!--begin:Menu section-->
                                    <div class="mb-6">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Creative Layout</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/creative/sign-in.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-in</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/creative/sign-up.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-up</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/creative/two-steps.html"
                                               class="menu-link">
                                                <span class="menu-title">Two-steps</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/creative/reset-password.html"
                                               class="menu-link">
                                                <span class="menu-title">Reset Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/creative/new-password.html"
                                               class="menu-link">
                                                <span class="menu-title">New Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                    <!--begin:Menu section-->
                                    <div class="mb-6">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Fancy Layout</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/fancy/sign-in.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-in</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/fancy/sign-up.html"
                                               class="menu-link">
                                                <span class="menu-title">Sign-up</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/fancy/two-steps.html"
                                               class="menu-link">
                                                <span class="menu-title">Two-steps</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/fancy/reset-password.html"
                                               class="menu-link">
                                                <span class="menu-title">Reset Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/layouts/fancy/new-password.html"
                                               class="menu-link">
                                                <span class="menu-title">New Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-3 mb-6 mb-lg-0">
                                    <!--begin:Menu section-->
                                    <div class="mb-0">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">General</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html"
                                               class="menu-link">
                                                <span class="menu-title">Multi-steps Sign-up</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/extended/two-factor-auth.html"
                                               class="menu-link">
                                                <span class="menu-title">Two Factor Auth</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/welcome.html" class="menu-link">
                                                <span class="menu-title">Welcome Message</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/verify-email.html" class="menu-link">
                                                <span class="menu-title">Verify Email</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/extended/coming-soon.html" class="menu-link">
                                                <span class="menu-title">Coming Soon</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/password-confirmation.html"
                                               class="menu-link">
                                                <span class="menu-title">Password Confirmation</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/account-deactivated.html"
                                               class="menu-link">
                                                <span class="menu-title">Account Deactivation</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/error-404.html" class="menu-link">
                                                <span class="menu-title">Error 404</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/general/error-500.html" class="menu-link">
                                                <span class="menu-title">Error 500</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-3 mb-6 mb-lg-0">
                                    <!--begin:Menu section-->
                                    <div class="mb-0">
                                        <!--begin:Menu heading-->
                                        <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Email Templates</h4>
                                        <!--end:Menu heading-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/email/verify-email.html" class="menu-link">
                                                <span class="menu-title">Verify Email</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/email/invitation.html" class="menu-link">
                                                <span class="menu-title">Account Invitation</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/email/password-reset.html" class="menu-link">
                                                <span class="menu-title">Reset Password</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item p-0 m-0">
                                            <!--begin:Menu link-->
                                            <a href="../../demo1/dist/authentication/email/password-change.html"
                                               class="menu-link">
                                                <span class="menu-title">Password Changed</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                    </div>
                                    <!--end:Menu section-->
                                </div>
                                <!--end:Col-->
                            </div>
                            <!--end:Row-->
                        </div>
                        <!--end:Tab pane-->
                        <!--begin:Tab pane-->
                        <div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_utilities">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-7">
                                    <!--begin:Row-->
                                    <div class="row">
                                        <!--begin:Col-->
                                        <div class="col-lg-4 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">General Modals</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/general/invite-friends.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Invite Friends</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/general/view-users.html"
                                                       class="menu-link">
                                                        <span class="menu-title">View Users</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/general/select-users.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Select Users</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/general/upgrade-plan.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Upgrade Plan</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/general/share-earn.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Share &amp; Earn</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/forms/new-target.html"
                                                       class="menu-link">
                                                        <span class="menu-title">New Target</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/forms/new-card.html"
                                                       class="menu-link">
                                                        <span class="menu-title">New Card</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/forms/new-address.html"
                                                       class="menu-link">
                                                        <span class="menu-title">New Address</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/forms/create-api-key.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create API Key</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/forms/bidding.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Bidding</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-4 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-6">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Advanced Modals</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/create-app.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create App</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/create-campaign.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Campaign</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/create-account.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Business Acc</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/create-project.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Project</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/top-up-wallet.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Top Up Wallet</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/offer-a-deal.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Offer a Deal</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/two-factor-authentication.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Two Factor Auth</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Search</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/search/horizontal.html" class="menu-link">
                                                        <span class="menu-title">Horizontal</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/search/vertical.html" class="menu-link">
                                                        <span class="menu-title">Vertical</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/search/users.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Users</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/search/select-location.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Select Location</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                        <!--begin:Col-->
                                        <div class="col-lg-4 mb-6 mb-lg-0">
                                            <!--begin:Menu section-->
                                            <div class="mb-0">
                                                <!--begin:Menu heading-->
                                                <h4 class="fs-6 fs-lg-4 fw-bold mb-3 ms-4">Wizards</h4>
                                                <!--end:Menu heading-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/horizontal.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Horizontal</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/vertical.html" class="menu-link">
                                                        <span class="menu-title">Vertical</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/two-factor-authentication.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Two Factor Auth</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/create-app.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create App</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/create-campaign.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Campaign</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/create-account.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Account</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/create-project.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Create Project</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/modals/wizards/top-up-wallet.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Top Up Wallet</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item p-0 m-0">
                                                    <!--begin:Menu link-->
                                                    <a href="../../demo1/dist/utilities/wizards/offer-a-deal.html"
                                                       class="menu-link">
                                                        <span class="menu-title">Offer a Deal</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu section-->
                                        </div>
                                        <!--end:Col-->
                                    </div>
                                    <!--end:Row-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-5 pe-lg-5">
                                    <img src="dashboard/media/stock/600x600/img-84.jpg" class="rounded mw-100" alt=""/>
                                </div>
                                <!--end:Col-->
                            </div>
                            <!--end:Row-->
                        </div>
                        <!--end:Tab pane-->
                        <!--begin:Tab pane-->
                        <div class="tab-pane w-lg-500px" id="kt_app_header_menu_pages_widgets">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-4 mb-6 mb-lg-0">
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/lists.html" class="menu-link">
                                            <span class="menu-title">Lists</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/statistics.html" class="menu-link">
                                            <span class="menu-title">Statistics</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/charts.html" class="menu-link">
                                            <span class="menu-title">Charts</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/mixed.html" class="menu-link">
                                            <span class="menu-title">Mixed</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/tables.html" class="menu-link">
                                            <span class="menu-title">Tables</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="../../demo1/dist/widgets/feeds.html" class="menu-link">
                                            <span class="menu-title">Feeds</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-8">
                                    <img src="dashboard/media/stock/900x600/44.jpg" class="rounded mw-100" alt=""/>
                                </div>
                                <!--end:Col-->
                            </div>
                            <!--end:Row-->
                        </div>
                        <!--end:Tab pane-->
                    </div>
                    <!--end:Tab content-->

                </div>
                <!--end:Pages menu-->
            </div>
            <!--end:Menu sub-->
        </div>
        <!--end:Menu item-->
--}}{{--


    </div>
    <!--end::Menu-->
</div>

--}}

<!--begin::Navbar-->
<div class="d-flex align-items-center" id="kt_header_nav">
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
         data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}"
         class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">@yield('title')</h1>
        <!--end::Title-->
        <!--begin::Separator-->
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <!--end::Separator-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            @yield('breadcrumbs')
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--begin::Page title-->

    <!--end::Page title-->
</div>
<!--end::Navbar-->