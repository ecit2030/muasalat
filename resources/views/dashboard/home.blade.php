<x-pages.layout :title="t_('dashboard Home')">

    {{-- <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Engage widget 3-->
                    <div class="card bg-primary h-md-100" data-theme="light">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column pt-13 pb-14">
                            <!--begin::Heading-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <h1 class="fw-semibold text-white text-center lh-lg mb-9">Delivery is easy
                                    <br>
                                    <span class="fw-bolder">Start Your Delivery</span>
                                </h1>
                                <!--end::Title-->
                                <!--begin::Illustration-->
                                <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12"
                                    style="background-image:url('assets/media/svg/illustrations/easy/5.svg')"></div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Links-->
                            <div class="text-center">
                                <!--begin::Link-->
                                <a class="btn btn-sm bg-white btn-color-gray-800 me-2"
                                    data-bs-target="#kt_modal_bidding" data-bs-toggle="modal">New Delivery</a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a class="btn btn-sm bg-white btn-color-white bg-opacity-20"
                                    href="../../demo1/dist/pages/user-profile/projects.html">Quick Guide</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Chart widget 11-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Delivery Stats</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Users from all channels</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <ul class="nav" id="kt_chart_widget_11_tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                                            data-bs-toggle="tab" id="kt_charts_widget_11_tab_1"
                                            href="#kt_chart_widget_11_tab_content_1" aria-selected="false"
                                            tabindex="-1" role="tab">2020</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                                            data-bs-toggle="tab" id="kt_charts_widget_11_tab_2"
                                            href="#kt_chart_widget_11_tab_content_2" aria-selected="false"
                                            tabindex="-1" role="tab">2021</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active"
                                            data-bs-toggle="tab" id="kt_charts_widget_11_tab_3"
                                            href="#kt_chart_widget_11_tab_content_3" aria-selected="true"
                                            role="tab">Month</a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pb-0 pt-4">
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade" id="kt_chart_widget_11_tab_content_1" role="tabpanel"
                                    aria-labelledby="#kt_charts_widget_11_tab_1">
                                    <!--begin::Statistics-->
                                    <div class="mb-2">
                                        <!--begin::Statistics-->
                                        <span
                                            class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">1,349</span>
                                        <!--end::Statistics-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-400">Avarage cost per iteraction</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_11_chart_1" class="ms-n5 me-n3 min-h-auto w-100"
                                        style="height: 300px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade" id="kt_chart_widget_11_tab_content_2" role="tabpanel"
                                    aria-labelledby="#kt_charts_widget_11_tab_2">
                                    <!--begin::Statistics-->
                                    <div class="mb-2">
                                        <!--begin::Statistics-->
                                        <span
                                            class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">3,492</span>
                                        <!--end::Statistics-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-400">Avarage cost per iteraction</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_11_chart_2" class="ms-n5 me-n3 min-h-auto"
                                        style="height: 300px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade active show" id="kt_chart_widget_11_tab_content_3"
                                    role="tabpanel" aria-labelledby="#kt_charts_widget_11_tab_3">
                                    <!--begin::Statistics-->
                                    <div class="mb-2">
                                        <!--begin::Statistics-->
                                        <span
                                            class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">4,796</span>
                                        <!--end::Statistics-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-400">Deliveries in 30 Days</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_11_chart_3" class="ms-n5 me-n3 min-h-auto"
                                        style="height: 300px; min-height: 315px;">
                                        <div id="apexchartsx5nr5wx3"
                                            class="apexcharts-canvas apexchartsx5nr5wx3 apexcharts-theme-light"
                                            style="width: 764px; height: 300px;"><svg id="SvgjsSvg1532" width="764"
                                                height="300" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev"
                                                class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                                transform="translate(0, 0)"
                                                style="background: transparent none repeat scroll 0% 0%;">
                                                <g id="SvgjsG1534" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(44.33332824707031, 30)">
                                                    <defs id="SvgjsDefs1533">
                                                        <clipPath id="gridRectMaskx5nr5wx3">
                                                            <rect id="SvgjsRect1539" width="716.6666717529297"
                                                                height="222.30310013834634" x="-3.5"
                                                                y="-1.5" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskx5nr5wx3"></clipPath>
                                                        <clipPath id="nonForecastMaskx5nr5wx3"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskx5nr5wx3">
                                                            <rect id="SvgjsRect1540" width="713.6666717529297"
                                                                height="223.30310013834634" x="-2"
                                                                y="-2" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient1545" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1546" stop-opacity="0.4"
                                                                stop-color="rgba(80,205,137,0.4)" offset="0">
                                                            </stop>
                                                            <stop id="SvgjsStop1547" stop-opacity="0"
                                                                stop-color="rgba(255,255,255,0)" offset="0.8">
                                                            </stop>
                                                            <stop id="SvgjsStop1548" stop-opacity="0"
                                                                stop-color="rgba(255,255,255,0)" offset="1">
                                                            </stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <g id="SvgjsG1551" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1552" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -10)"><text id="SvgjsText1554"
                                                                font-family="inherit" x="0"
                                                                y="242.30310013834634" text-anchor="end"
                                                                dominant-baseline="auto" font-size="13px"
                                                                font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1555"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1557" font-family="inherit"
                                                                x="24.471264543204477" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1558"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1560" font-family="inherit"
                                                                x="48.942529086408946" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1561"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1563" font-family="inherit"
                                                                x="73.41379362961341" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1564"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1566" font-family="inherit"
                                                                x="97.88505817281788" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1567"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1569" font-family="inherit"
                                                                x="122.35632271602236" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 123.35632133483887 236.5030975341797)">
                                                                <tspan id="SvgjsTspan1570">Apr 06</tspan>
                                                                <title>Apr 06</title>
                                                            </text><text id="SvgjsText1572" font-family="inherit"
                                                                x="146.82758725922685" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1573"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1575" font-family="inherit"
                                                                x="171.29885180243133" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1576"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1578" font-family="inherit"
                                                                x="195.7701163456358" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1579"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1581" font-family="inherit"
                                                                x="220.2413808888403" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1582"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1584" font-family="inherit"
                                                                x="244.71264543204478" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 245.71264266967773 236.5030975341797)">
                                                                <tspan id="SvgjsTspan1585">Apr 10</tspan>
                                                                <title>Apr 10</title>
                                                            </text><text id="SvgjsText1587" font-family="inherit"
                                                                x="269.18390997524926" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1588"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1590" font-family="inherit"
                                                                x="293.65517451845375" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1591"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1593" font-family="inherit"
                                                                x="318.12643906165823" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1594"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1596" font-family="inherit"
                                                                x="342.5977036048627" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1597"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1599" font-family="inherit"
                                                                x="367.0689681480672" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 368.06897735595703 236.5030975341797)">
                                                                <tspan id="SvgjsTspan1600">Apr 14</tspan>
                                                                <title>Apr 14</title>
                                                            </text><text id="SvgjsText1602" font-family="inherit"
                                                                x="391.5402326912717" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1603"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1605" font-family="inherit"
                                                                x="416.01149723447617" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1606"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1608" font-family="inherit"
                                                                x="440.48276177768065" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1609"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1611" font-family="inherit"
                                                                x="464.95402632088513" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1612"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1614" font-family="inherit"
                                                                x="489.4252908640896" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 490.42529106140137 236.5030975341797)">
                                                                <tspan id="SvgjsTspan1615">Apr 18</tspan>
                                                                <title>Apr 18</title>
                                                            </text><text id="SvgjsText1617" font-family="inherit"
                                                                x="513.8965554072942" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1618"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1620" font-family="inherit"
                                                                x="538.3678199504986" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1621"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1623" font-family="inherit"
                                                                x="562.8390844937031" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1624"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1626" font-family="inherit"
                                                                x="587.3103490369076" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1627"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1629" font-family="inherit"
                                                                x="611.7816135801121" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 612.7816371917725 236.5030975341797)">
                                                                <tspan id="SvgjsTspan1630">Apr 22</tspan>
                                                                <title>Apr 22</title>
                                                            </text><text id="SvgjsText1632" font-family="inherit"
                                                                x="636.2528781233166" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1633"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1635" font-family="inherit"
                                                                x="660.7241426665211" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1636"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1638" font-family="inherit"
                                                                x="685.1954072097255" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1639"></tspan>
                                                                <title></title>
                                                            </text><text id="SvgjsText1641" font-family="inherit"
                                                                x="709.66667175293" y="242.30310013834634"
                                                                text-anchor="end" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;"
                                                                transform="rotate(0 1 -1)">
                                                                <tspan id="SvgjsTspan1642"></tspan>
                                                                <title></title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG1660" class="apexcharts-grid">
                                                        <g id="SvgjsG1661" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine1663" x1="0" y1="0"
                                                                x2="709.6666717529297" y2="0"
                                                                stroke="#e4e6ef" stroke-dasharray="3"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine1664" x1="0"
                                                                y1="54.825775034586584" x2="709.6666717529297"
                                                                y2="54.825775034586584" stroke="#e4e6ef"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1665" x1="0"
                                                                y1="109.65155006917317" x2="709.6666717529297"
                                                                y2="109.65155006917317" stroke="#e4e6ef"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1666" x1="0"
                                                                y1="164.47732510375977" x2="709.6666717529297"
                                                                y2="164.47732510375977" stroke="#e4e6ef"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1667" x1="0"
                                                                y1="219.30310013834634" x2="709.6666717529297"
                                                                y2="219.30310013834634" stroke="#e4e6ef"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1662" class="apexcharts-gridlines-vertical"></g>
                                                        <line id="SvgjsLine1669" x1="0"
                                                            y1="219.30310013834634" x2="709.6666717529297"
                                                            y2="219.30310013834634" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        <line id="SvgjsLine1668" x1="0" y1="1"
                                                            x2="0" y2="219.30310013834634"
                                                            stroke="transparent" stroke-dasharray="0"
                                                            stroke-linecap="butt"></line>
                                                    </g>
                                                    <g id="SvgjsG1541"
                                                        class="apexcharts-area-series apexcharts-plot-series">
                                                        <g id="SvgjsG1542" class="apexcharts-series"
                                                            seriesName="Deliveries" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1549"
                                                                d="M 0 219.30310013834634L 0 109.6515500691732C 8.564942590121564 109.6515500691732 15.906321953082909 62.65802861095614 24.471264543204473 62.65802861095614C 33.03620713332604 62.65802861095614 40.37758649628738 62.65802861095614 48.942529086408946 62.65802861095614C 57.507471676530514 62.65802861095614 64.84885103949186 78.32253576369516 73.41379362961342 78.32253576369516C 81.97873621973498 78.32253576369516 89.32011558269633 78.32253576369516 97.88505817281789 78.32253576369516C 106.45000076293945 78.32253576369516 113.7913801259008 109.6515500691732 122.35632271602236 109.6515500691732C 130.92126530614394 109.6515500691732 138.26264466910527 109.6515500691732 146.82758725922685 109.6515500691732C 155.3925298493484 109.6515500691732 162.73390921230975 78.32253576369516 171.2988518024313 78.32253576369516C 179.86379439255288 78.32253576369516 187.2051737555142 78.32253576369516 195.77011634563578 78.32253576369516C 204.33505893575733 78.32253576369516 211.6764382987187 46.99352145821712 220.24138088884024 46.99352145821712C 228.80632347896181 46.99352145821712 236.14770284192315 46.99352145821712 244.71264543204472 46.99352145821712C 253.2775880221663 46.99352145821712 260.61896738512763 78.32253576369516 269.1839099752492 78.32253576369516C 277.7488525653708 78.32253576369516 285.0902319283321 78.32253576369516 293.6551745184537 78.32253576369516C 302.22011710857527 78.32253576369516 309.56149647153654 46.99352145821712 318.1264390616581 46.99352145821712C 326.6913816517797 46.99352145821712 334.032761014741 46.99352145821712 342.5977036048626 46.99352145821712C 351.1626461949842 46.99352145821712 358.5040255579455 93.98704291643418 367.0689681480671 93.98704291643418C 375.63391073818866 93.98704291643418 382.97529010115 93.98704291643418 391.54023269127157 93.98704291643418C 400.10517528139314 93.98704291643418 407.4465546443545 125.31605722191222 416.01149723447605 125.31605722191222C 424.5764398245976 125.31605722191222 431.9178191875589 109.6515500691732 440.4827617776805 109.6515500691732C 449.04770436780206 109.6515500691732 456.3890837307634 109.6515500691732 464.95402632088496 109.6515500691732C 473.51896891100654 109.6515500691732 480.8603482739679 78.32253576369516 489.42529086408945 78.32253576369516C 497.990233454211 78.32253576369516 505.33161281717236 78.32253576369516 513.8965554072939 78.32253576369516C 522.4614979974154 78.32253576369516 529.8028773603769 46.99352145821712 538.3678199504984 46.99352145821712C 546.9327625406199 46.99352145821712 554.2741419035814 46.99352145821712 562.8390844937029 46.99352145821712C 571.4040270838244 46.99352145821712 578.7454064467859 78.32253576369516 587.3103490369074 78.32253576369516C 595.8752916270289 78.32253576369516 603.2166709899902 78.32253576369516 611.7816135801118 78.32253576369516C 620.3465561702333 78.32253576369516 627.6879355331947 109.6515500691732 636.2528781233162 109.6515500691732C 644.8178207134378 109.6515500691732 652.1592000763992 109.6515500691732 660.7241426665207 109.6515500691732C 669.2890852566422 109.6515500691732 676.6304646196037 93.98704291643418 685.1954072097252 93.98704291643418C 693.7603497998467 93.98704291643418 701.1017291628082 93.98704291643418 709.6666717529297 93.98704291643418C 709.6666717529297 93.98704291643418 709.6666717529297 93.98704291643418 709.6666717529297 219.30310013834634M 709.6666717529297 93.98704291643418z"
                                                                fill="url(#SvgjsLinearGradient1545)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-area" index="0"
                                                                clip-path="url(#gridRectMaskx5nr5wx3)"
                                                                pathTo="M 0 219.30310013834634L 0 109.6515500691732C 8.564942590121564 109.6515500691732 15.906321953082909 62.65802861095614 24.471264543204473 62.65802861095614C 33.03620713332604 62.65802861095614 40.37758649628738 62.65802861095614 48.942529086408946 62.65802861095614C 57.507471676530514 62.65802861095614 64.84885103949186 78.32253576369516 73.41379362961342 78.32253576369516C 81.97873621973498 78.32253576369516 89.32011558269633 78.32253576369516 97.88505817281789 78.32253576369516C 106.45000076293945 78.32253576369516 113.7913801259008 109.6515500691732 122.35632271602236 109.6515500691732C 130.92126530614394 109.6515500691732 138.26264466910527 109.6515500691732 146.82758725922685 109.6515500691732C 155.3925298493484 109.6515500691732 162.73390921230975 78.32253576369516 171.2988518024313 78.32253576369516C 179.86379439255288 78.32253576369516 187.2051737555142 78.32253576369516 195.77011634563578 78.32253576369516C 204.33505893575733 78.32253576369516 211.6764382987187 46.99352145821712 220.24138088884024 46.99352145821712C 228.80632347896181 46.99352145821712 236.14770284192315 46.99352145821712 244.71264543204472 46.99352145821712C 253.2775880221663 46.99352145821712 260.61896738512763 78.32253576369516 269.1839099752492 78.32253576369516C 277.7488525653708 78.32253576369516 285.0902319283321 78.32253576369516 293.6551745184537 78.32253576369516C 302.22011710857527 78.32253576369516 309.56149647153654 46.99352145821712 318.1264390616581 46.99352145821712C 326.6913816517797 46.99352145821712 334.032761014741 46.99352145821712 342.5977036048626 46.99352145821712C 351.1626461949842 46.99352145821712 358.5040255579455 93.98704291643418 367.0689681480671 93.98704291643418C 375.63391073818866 93.98704291643418 382.97529010115 93.98704291643418 391.54023269127157 93.98704291643418C 400.10517528139314 93.98704291643418 407.4465546443545 125.31605722191222 416.01149723447605 125.31605722191222C 424.5764398245976 125.31605722191222 431.9178191875589 109.6515500691732 440.4827617776805 109.6515500691732C 449.04770436780206 109.6515500691732 456.3890837307634 109.6515500691732 464.95402632088496 109.6515500691732C 473.51896891100654 109.6515500691732 480.8603482739679 78.32253576369516 489.42529086408945 78.32253576369516C 497.990233454211 78.32253576369516 505.33161281717236 78.32253576369516 513.8965554072939 78.32253576369516C 522.4614979974154 78.32253576369516 529.8028773603769 46.99352145821712 538.3678199504984 46.99352145821712C 546.9327625406199 46.99352145821712 554.2741419035814 46.99352145821712 562.8390844937029 46.99352145821712C 571.4040270838244 46.99352145821712 578.7454064467859 78.32253576369516 587.3103490369074 78.32253576369516C 595.8752916270289 78.32253576369516 603.2166709899902 78.32253576369516 611.7816135801118 78.32253576369516C 620.3465561702333 78.32253576369516 627.6879355331947 109.6515500691732 636.2528781233162 109.6515500691732C 644.8178207134378 109.6515500691732 652.1592000763992 109.6515500691732 660.7241426665207 109.6515500691732C 669.2890852566422 109.6515500691732 676.6304646196037 93.98704291643418 685.1954072097252 93.98704291643418C 693.7603497998467 93.98704291643418 701.1017291628082 93.98704291643418 709.6666717529297 93.98704291643418C 709.6666717529297 93.98704291643418 709.6666717529297 93.98704291643418 709.6666717529297 219.30310013834634M 709.6666717529297 93.98704291643418z"
                                                                pathFrom="M -1 375.9481716657366L -1 375.9481716657366L 24.471264543204473 375.9481716657366L 48.942529086408946 375.9481716657366L 73.41379362961342 375.9481716657366L 97.88505817281789 375.9481716657366L 122.35632271602236 375.9481716657366L 146.82758725922685 375.9481716657366L 171.2988518024313 375.9481716657366L 195.77011634563578 375.9481716657366L 220.24138088884024 375.9481716657366L 244.71264543204472 375.9481716657366L 269.1839099752492 375.9481716657366L 293.6551745184537 375.9481716657366L 318.1264390616581 375.9481716657366L 342.5977036048626 375.9481716657366L 367.0689681480671 375.9481716657366L 391.54023269127157 375.9481716657366L 416.01149723447605 375.9481716657366L 440.4827617776805 375.9481716657366L 464.95402632088496 375.9481716657366L 489.42529086408945 375.9481716657366L 513.8965554072939 375.9481716657366L 538.3678199504984 375.9481716657366L 562.8390844937029 375.9481716657366L 587.3103490369074 375.9481716657366L 611.7816135801118 375.9481716657366L 636.2528781233162 375.9481716657366L 660.7241426665207 375.9481716657366L 685.1954072097252 375.9481716657366L 709.6666717529297 375.9481716657366">
                                                            </path>
                                                            <path id="SvgjsPath1550"
                                                                d="M 0 109.6515500691732C 8.564942590121564 109.6515500691732 15.906321953082909 62.65802861095614 24.471264543204473 62.65802861095614C 33.03620713332604 62.65802861095614 40.37758649628738 62.65802861095614 48.942529086408946 62.65802861095614C 57.507471676530514 62.65802861095614 64.84885103949186 78.32253576369516 73.41379362961342 78.32253576369516C 81.97873621973498 78.32253576369516 89.32011558269633 78.32253576369516 97.88505817281789 78.32253576369516C 106.45000076293945 78.32253576369516 113.7913801259008 109.6515500691732 122.35632271602236 109.6515500691732C 130.92126530614394 109.6515500691732 138.26264466910527 109.6515500691732 146.82758725922685 109.6515500691732C 155.3925298493484 109.6515500691732 162.73390921230975 78.32253576369516 171.2988518024313 78.32253576369516C 179.86379439255288 78.32253576369516 187.2051737555142 78.32253576369516 195.77011634563578 78.32253576369516C 204.33505893575733 78.32253576369516 211.6764382987187 46.99352145821712 220.24138088884024 46.99352145821712C 228.80632347896181 46.99352145821712 236.14770284192315 46.99352145821712 244.71264543204472 46.99352145821712C 253.2775880221663 46.99352145821712 260.61896738512763 78.32253576369516 269.1839099752492 78.32253576369516C 277.7488525653708 78.32253576369516 285.0902319283321 78.32253576369516 293.6551745184537 78.32253576369516C 302.22011710857527 78.32253576369516 309.56149647153654 46.99352145821712 318.1264390616581 46.99352145821712C 326.6913816517797 46.99352145821712 334.032761014741 46.99352145821712 342.5977036048626 46.99352145821712C 351.1626461949842 46.99352145821712 358.5040255579455 93.98704291643418 367.0689681480671 93.98704291643418C 375.63391073818866 93.98704291643418 382.97529010115 93.98704291643418 391.54023269127157 93.98704291643418C 400.10517528139314 93.98704291643418 407.4465546443545 125.31605722191222 416.01149723447605 125.31605722191222C 424.5764398245976 125.31605722191222 431.9178191875589 109.6515500691732 440.4827617776805 109.6515500691732C 449.04770436780206 109.6515500691732 456.3890837307634 109.6515500691732 464.95402632088496 109.6515500691732C 473.51896891100654 109.6515500691732 480.8603482739679 78.32253576369516 489.42529086408945 78.32253576369516C 497.990233454211 78.32253576369516 505.33161281717236 78.32253576369516 513.8965554072939 78.32253576369516C 522.4614979974154 78.32253576369516 529.8028773603769 46.99352145821712 538.3678199504984 46.99352145821712C 546.9327625406199 46.99352145821712 554.2741419035814 46.99352145821712 562.8390844937029 46.99352145821712C 571.4040270838244 46.99352145821712 578.7454064467859 78.32253576369516 587.3103490369074 78.32253576369516C 595.8752916270289 78.32253576369516 603.2166709899902 78.32253576369516 611.7816135801118 78.32253576369516C 620.3465561702333 78.32253576369516 627.6879355331947 109.6515500691732 636.2528781233162 109.6515500691732C 644.8178207134378 109.6515500691732 652.1592000763992 109.6515500691732 660.7241426665207 109.6515500691732C 669.2890852566422 109.6515500691732 676.6304646196037 93.98704291643418 685.1954072097252 93.98704291643418C 693.7603497998467 93.98704291643418 701.1017291628082 93.98704291643418 709.6666717529297 93.98704291643418"
                                                                fill="none" fill-opacity="1" stroke="#50cd89"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="3" stroke-dasharray="0"
                                                                class="apexcharts-area" index="0"
                                                                clip-path="url(#gridRectMaskx5nr5wx3)"
                                                                pathTo="M 0 109.6515500691732C 8.564942590121564 109.6515500691732 15.906321953082909 62.65802861095614 24.471264543204473 62.65802861095614C 33.03620713332604 62.65802861095614 40.37758649628738 62.65802861095614 48.942529086408946 62.65802861095614C 57.507471676530514 62.65802861095614 64.84885103949186 78.32253576369516 73.41379362961342 78.32253576369516C 81.97873621973498 78.32253576369516 89.32011558269633 78.32253576369516 97.88505817281789 78.32253576369516C 106.45000076293945 78.32253576369516 113.7913801259008 109.6515500691732 122.35632271602236 109.6515500691732C 130.92126530614394 109.6515500691732 138.26264466910527 109.6515500691732 146.82758725922685 109.6515500691732C 155.3925298493484 109.6515500691732 162.73390921230975 78.32253576369516 171.2988518024313 78.32253576369516C 179.86379439255288 78.32253576369516 187.2051737555142 78.32253576369516 195.77011634563578 78.32253576369516C 204.33505893575733 78.32253576369516 211.6764382987187 46.99352145821712 220.24138088884024 46.99352145821712C 228.80632347896181 46.99352145821712 236.14770284192315 46.99352145821712 244.71264543204472 46.99352145821712C 253.2775880221663 46.99352145821712 260.61896738512763 78.32253576369516 269.1839099752492 78.32253576369516C 277.7488525653708 78.32253576369516 285.0902319283321 78.32253576369516 293.6551745184537 78.32253576369516C 302.22011710857527 78.32253576369516 309.56149647153654 46.99352145821712 318.1264390616581 46.99352145821712C 326.6913816517797 46.99352145821712 334.032761014741 46.99352145821712 342.5977036048626 46.99352145821712C 351.1626461949842 46.99352145821712 358.5040255579455 93.98704291643418 367.0689681480671 93.98704291643418C 375.63391073818866 93.98704291643418 382.97529010115 93.98704291643418 391.54023269127157 93.98704291643418C 400.10517528139314 93.98704291643418 407.4465546443545 125.31605722191222 416.01149723447605 125.31605722191222C 424.5764398245976 125.31605722191222 431.9178191875589 109.6515500691732 440.4827617776805 109.6515500691732C 449.04770436780206 109.6515500691732 456.3890837307634 109.6515500691732 464.95402632088496 109.6515500691732C 473.51896891100654 109.6515500691732 480.8603482739679 78.32253576369516 489.42529086408945 78.32253576369516C 497.990233454211 78.32253576369516 505.33161281717236 78.32253576369516 513.8965554072939 78.32253576369516C 522.4614979974154 78.32253576369516 529.8028773603769 46.99352145821712 538.3678199504984 46.99352145821712C 546.9327625406199 46.99352145821712 554.2741419035814 46.99352145821712 562.8390844937029 46.99352145821712C 571.4040270838244 46.99352145821712 578.7454064467859 78.32253576369516 587.3103490369074 78.32253576369516C 595.8752916270289 78.32253576369516 603.2166709899902 78.32253576369516 611.7816135801118 78.32253576369516C 620.3465561702333 78.32253576369516 627.6879355331947 109.6515500691732 636.2528781233162 109.6515500691732C 644.8178207134378 109.6515500691732 652.1592000763992 109.6515500691732 660.7241426665207 109.6515500691732C 669.2890852566422 109.6515500691732 676.6304646196037 93.98704291643418 685.1954072097252 93.98704291643418C 693.7603497998467 93.98704291643418 701.1017291628082 93.98704291643418 709.6666717529297 93.98704291643418"
                                                                pathFrom="M -1 375.9481716657366L -1 375.9481716657366L 24.471264543204473 375.9481716657366L 48.942529086408946 375.9481716657366L 73.41379362961342 375.9481716657366L 97.88505817281789 375.9481716657366L 122.35632271602236 375.9481716657366L 146.82758725922685 375.9481716657366L 171.2988518024313 375.9481716657366L 195.77011634563578 375.9481716657366L 220.24138088884024 375.9481716657366L 244.71264543204472 375.9481716657366L 269.1839099752492 375.9481716657366L 293.6551745184537 375.9481716657366L 318.1264390616581 375.9481716657366L 342.5977036048626 375.9481716657366L 367.0689681480671 375.9481716657366L 391.54023269127157 375.9481716657366L 416.01149723447605 375.9481716657366L 440.4827617776805 375.9481716657366L 464.95402632088496 375.9481716657366L 489.42529086408945 375.9481716657366L 513.8965554072939 375.9481716657366L 538.3678199504984 375.9481716657366L 562.8390844937029 375.9481716657366L 587.3103490369074 375.9481716657366L 611.7816135801118 375.9481716657366L 636.2528781233162 375.9481716657366L 660.7241426665207 375.9481716657366L 685.1954072097252 375.9481716657366L 709.6666717529297 375.9481716657366">
                                                            </path>
                                                            <g id="SvgjsG1543" class="apexcharts-series-markers-wrap"
                                                                data:realIndex="0">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle1677" r="0"
                                                                        cx="0" cy="0"
                                                                        class="apexcharts-marker wm5dzcluo no-pointer-events"
                                                                        stroke="#50cd89" fill="#50cd89"
                                                                        fill-opacity="1" stroke-width="3"
                                                                        stroke-opacity="0.9" default-marker-size="0">
                                                                    </circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1544" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine1671" x1="0" y1="0"
                                                        x2="0" y2="219.30310013834634" stroke="#50cd89"
                                                        stroke-dasharray="3" stroke-linecap="butt"
                                                        class="apexcharts-xcrosshairs" x="0" y="0"
                                                        width="1" height="219.30310013834634" fill="#b1b9c4"
                                                        filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                    <line id="SvgjsLine1672" x1="0" y1="0"
                                                        x2="709.6666717529297" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1673" x1="0" y1="0"
                                                        x2="709.6666717529297" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1674" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1675" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1676" class="apexcharts-point-annotations"></g>
                                                    <rect id="SvgjsRect1678" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe"
                                                        class="apexcharts-zoom-rect"></rect>
                                                    <rect id="SvgjsRect1679" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe"
                                                        class="apexcharts-selection-rect"></rect>
                                                </g>
                                                <g id="SvgjsG1643" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(14.333328247070312, 0)">
                                                    <g id="SvgjsG1644" class="apexcharts-yaxis-texts-g"><text
                                                            id="SvgjsText1646" font-family="inherit" x="20"
                                                            y="31.4" text-anchor="end" dominant-baseline="auto"
                                                            font-size="13px" font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1647">24</tspan>
                                                            <title>24</title>
                                                        </text><text id="SvgjsText1649" font-family="inherit"
                                                            x="20" y="86.22577503458659" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1650">21</tspan>
                                                            <title>21</title>
                                                        </text><text id="SvgjsText1652" font-family="inherit"
                                                            x="20" y="141.05155006917317" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1653">17</tspan>
                                                            <title>17</title>
                                                        </text><text id="SvgjsText1655" font-family="inherit"
                                                            x="20" y="195.87732510375977" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1656">14</tspan>
                                                            <title>14</title>
                                                        </text><text id="SvgjsText1658" font-family="inherit"
                                                            x="20" y="250.70310013834634" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1659">10</tspan>
                                                            <title>10</title>
                                                        </text></g>
                                                </g>
                                                <rect id="SvgjsRect1670" width="0" height="0"
                                                    x="0" y="0" rx="0" ry="0"
                                                    opacity="1" stroke-width="0" stroke="none"
                                                    stroke-dasharray="0" fill="#fefefe"></rect>
                                                <g id="SvgjsG1535" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 150px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: inherit; font-size: 12px;"></div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(80, 205, 137);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: inherit; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light">
                                                <div class="apexcharts-xaxistooltip-text"
                                                    style="font-family: inherit; font-size: 13px;"></div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 11-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 16-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Delivery Tracking</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">56 deliveries in progress</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="tooltip"
                                    data-bs-dismiss="click" data-bs-custom-class="tooltip-inverse"
                                    data-kt-initialized="1">View All</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-4 px-0">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom item position-relative mx-9 mb-9"
                                role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item col-4 mx-0 p-0" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100"
                                        data-bs-toggle="pill" href="#kt_list_widget_16_tab_1" aria-selected="false"
                                        role="tab" tabindex="-1">
                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">New</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100"
                                        data-bs-toggle="pill" href="#kt_list_widget_16_tab_2" aria-selected="false"
                                        role="tab" tabindex="-1">
                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Preparing</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item col-4 mx-0 px-0" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100 active"
                                        data-bs-toggle="pill" href="#kt_list_widget_16_tab_3" aria-selected="true"
                                        role="tab">
                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Shipping</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Bullet-->
                                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                                <!--end::Bullet-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content px-9 hover-scroll-overlay-y pe-7 me-3 mb-2" style="height: 454px">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_list_widget_16_tab_1" role="tabpanel">
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn
                                                        Simmons</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">6391 Elgin St. Celina,
                                                        Delaware 10299</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph
                                                        Edwards</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">2464 Royal Ln. Mesa, New
                                                        Jersey 45463</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd. Inglewood,
                                                        Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert
                                                        Flores</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3517 W. Gray St. Utica,
                                                        Pennsylvania 57867</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie
                                                        Clarcson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">Total 2,356 Items in the
                                                        Stock</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd.
                                                        Inglewood, Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn
                                                        Simmons</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">6391 Elgin St. Celina,
                                                        Delaware 10299</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph
                                                        Edwards</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">2464 Royal Ln. Mesa, New
                                                        Jersey 45463</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_list_widget_16_tab_2" role="tabpanel">
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd.
                                                        Inglewood, Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn
                                                        Simmons</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">6391 Elgin St. Celina,
                                                        Delaware 10299</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph
                                                        Edwards</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">2464 Royal Ln. Mesa, New
                                                        Jersey 45463</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd.
                                                        Inglewood, Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert
                                                        Flores</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3517 W. Gray St. Utica,
                                                        Pennsylvania 57867</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie
                                                        Clarcson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">Total 2,356 Items in the
                                                        Stock</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert
                                                        Flores</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3517 W. Gray St. Utica,
                                                        Pennsylvania 57867</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie
                                                        Clarcson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">Total 2,356 Items in the
                                                        Stock</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_list_widget_16_tab_3"
                                    role="tabpanel">
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert
                                                        Flores</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3517 W. Gray St. Utica,
                                                        Pennsylvania 57867</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie
                                                        Clarcson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">Total 2,356 Items in the
                                                        Stock</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn
                                                        Simmons</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">6391 Elgin St. Celina,
                                                        Delaware 10299</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph
                                                        Edwards</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">2464 Royal Ln. Mesa, New
                                                        Jersey 45463</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn
                                                        Simmons</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">6391 Elgin St. Celina,
                                                        Delaware 10299</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph
                                                        Edwards</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">2464 Royal Ln. Mesa, New
                                                        Jersey 45463</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd.
                                                        Inglewood, Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-5 mb-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <!--begin::Timeline-->
                                        <div class="timeline ms-n1">
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center mb-4">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px mt-9 mb-n14"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.7px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen015.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron
                                                        Williamson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">3891 Ranchview Dr.
                                                        Richardson, California 62639</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                            <!--begin::Timeline item-->
                                            <div class="timeline-item align-items-center">
                                                <!--begin::Timeline line-->
                                                <div class="timeline-line w-20px"></div>
                                                <!--end::Timeline line-->
                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Timeline icon-->
                                                <!--begin::Timeline content-->
                                                <div class="timeline-content m-0">
                                                    <!--begin::Label-->
                                                    <span
                                                        class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                                    <!--begin::Label-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin
                                                        Watson</a>
                                                    <!--end::Title-->
                                                    <!--begin::Title-->
                                                    <span class="fw-semibold text-gray-400">8502 Preston Rd.
                                                        Inglewood, Maine 98380</span>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <!--end::Timeline item-->
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 16-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Chart widget 32-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-3">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Deliveries by Category</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Total 424,567 deliveries</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                    class="btn btn-sm btn-light d-flex align-items-center px-4"
                                    data-kt-initialized="1">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">١٠ يوليو ٢٠٢٢ - ٨ أغسطس ٢٠٢٢</div>
                                    <!--end::Display range-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                    <span class="svg-icon svg-icon-1 ms-2 me-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column justify-content-between pb-5 px-0">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3 mx-9" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active"
                                        data-bs-toggle="pill" id="kt_charts_widget_32_tab_1"
                                        href="#kt_charts_widget_32_tab_content_1" aria-selected="true"
                                        role="tab">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-truck fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Van</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" id="kt_charts_widget_32_tab_2"
                                        href="#kt_charts_widget_32_tab_content_2" aria-selected="false"
                                        tabindex="-1" role="tab">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-bicycle fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Bike</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" id="kt_charts_widget_32_tab_3"
                                        href="#kt_charts_widget_32_tab_content_3" aria-selected="false"
                                        tabindex="-1" role="tab">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-drone fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Drone</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content ps-4 pe-6">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_charts_widget_32_tab_content_1"
                                    role="tabpanel" aria-labelledby="#kt_charts_widget_32_tab_1">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_32_chart_1" class="min-h-auto"
                                        style="height: 375px; min-height: 390px;">
                                        <div id="apexchartsewzf0fcc"
                                            class="apexcharts-canvas apexchartsewzf0fcc apexcharts-theme-light"
                                            style="width: 764px; height: 375px;"><svg id="SvgjsSvg1680"
                                                width="764" height="375" xmlns="http://www.w3.org/2000/svg"
                                                version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent none repeat scroll 0% 0%;">
                                                <g id="SvgjsG1682" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(50.33332824707031, 30)">
                                                    <defs id="SvgjsDefs1681">
                                                        <linearGradient id="SvgjsLinearGradient1686" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1687" stop-opacity="0"
                                                                stop-color="rgba(216,227,240,0)" offset="0">
                                                            </stop>
                                                            <stop id="SvgjsStop1688" stop-opacity="0"
                                                                stop-color="rgba(190,209,230,0)" offset="1">
                                                            </stop>
                                                            <stop id="SvgjsStop1689" stop-opacity="0"
                                                                stop-color="rgba(190,209,230,0)" offset="1">
                                                            </stop>
                                                        </linearGradient>
                                                        <clipPath id="gridRectMaskewzf0fcc">
                                                            <rect id="SvgjsRect1691" width="709.6666717529297"
                                                                height="306.11199999999997" x="-3"
                                                                y="-1" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskewzf0fcc"></clipPath>
                                                        <clipPath id="nonForecastMaskewzf0fcc"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskewzf0fcc">
                                                            <rect id="SvgjsRect1692" width="707.6666717529297"
                                                                height="308.11199999999997" x="-2"
                                                                y="-2" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <rect id="SvgjsRect1690" width="22.115238255092077"
                                                        height="304.11199999999997" x="0" y="0"
                                                        rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke-dasharray="3"
                                                        fill="url(#SvgjsLinearGradient1686)"
                                                        class="apexcharts-xcrosshairs" y2="304.11199999999997"
                                                        filter="none" fill-opacity="0.9"></rect>
                                                    <g id="SvgjsG1739" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1740" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"><text id="SvgjsText1742"
                                                                font-family="inherit" x="50.26190512520926"
                                                                y="333.11199999999997" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="13px"
                                                                font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1743">Grossey</tspan>
                                                                <title>Grossey</title>
                                                            </text><text id="SvgjsText1745" font-family="inherit"
                                                                x="150.78571537562777" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1746">Pet Food</tspan>
                                                                <title>Pet Food</title>
                                                            </text><text id="SvgjsText1748" font-family="inherit"
                                                                x="251.30952562604628" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1749">Flowers</tspan>
                                                                <title>Flowers</title>
                                                            </text><text id="SvgjsText1751" font-family="inherit"
                                                                x="351.83333587646484" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1752">Restaurant</tspan>
                                                                <title>Restaurant</title>
                                                            </text><text id="SvgjsText1754" font-family="inherit"
                                                                x="452.3571461268834" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1755">Kids Toys</tspan>
                                                                <title>Kids Toys</title>
                                                            </text><text id="SvgjsText1757" font-family="inherit"
                                                                x="552.8809563773018" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1758">Clothing</tspan>
                                                                <title>Clothing</title>
                                                            </text><text id="SvgjsText1760" font-family="inherit"
                                                                x="653.4047666277203" y="333.11199999999997"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="13px" font-weight="400" fill="#a1a5b7"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: inherit;">
                                                                <tspan id="SvgjsTspan1761">Still Water</tspan>
                                                                <title>Still Water</title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG1779" class="apexcharts-grid">
                                                        <g id="SvgjsG1780" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine1782" x1="0" y1="0"
                                                                x2="703.6666717529297" y2="0"
                                                                stroke="#e4e6ef" stroke-dasharray="4"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine1783" x1="0"
                                                                y1="76.02799999999999" x2="703.6666717529297"
                                                                y2="76.02799999999999" stroke="#e4e6ef"
                                                                stroke-dasharray="4" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1784" x1="0"
                                                                y1="152.05599999999998" x2="703.6666717529297"
                                                                y2="152.05599999999998" stroke="#e4e6ef"
                                                                stroke-dasharray="4" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1785" x1="0"
                                                                y1="228.08399999999997" x2="703.6666717529297"
                                                                y2="228.08399999999997" stroke="#e4e6ef"
                                                                stroke-dasharray="4" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1786" x1="0"
                                                                y1="304.11199999999997" x2="703.6666717529297"
                                                                y2="304.11199999999997" stroke="#e4e6ef"
                                                                stroke-dasharray="4" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1781" class="apexcharts-gridlines-vertical">
                                                        </g>
                                                        <line id="SvgjsLine1788" x1="0"
                                                            y1="304.11199999999997" x2="703.6666717529297"
                                                            y2="304.11199999999997" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        <line id="SvgjsLine1787" x1="0" y1="1"
                                                            x2="0" y2="304.11199999999997"
                                                            stroke="transparent" stroke-dasharray="0"
                                                            stroke-linecap="butt"></line>
                                                    </g>
                                                    <g id="SvgjsG1693"
                                                        class="apexcharts-bar-series apexcharts-plot-series">
                                                        <g id="SvgjsG1694" class="apexcharts-series"
                                                            rel="1" seriesName="Deliveries"
                                                            data:realIndex="0">
                                                            <path id="SvgjsPath1698"
                                                                d="M 39.20428599766322 304.11199999999997L 39.20428599766322 172.2616Q 39.20428599766322 167.2616 44.20428599766322 167.2616L 54.3195242527553 167.2616Q 59.3195242527553 167.2616 59.3195242527553 172.2616L 59.3195242527553 172.2616L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 39.20428599766322 304.11199999999997L 39.20428599766322 172.2616Q 39.20428599766322 167.2616 44.20428599766322 167.2616L 54.3195242527553 167.2616Q 59.3195242527553 167.2616 59.3195242527553 172.2616L 59.3195242527553 172.2616L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997z"
                                                                pathFrom="M 39.20428599766322 304.11199999999997L 39.20428599766322 304.11199999999997L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997L 59.3195242527553 304.11199999999997L 39.20428599766322 304.11199999999997"
                                                                cy="167.2616" cx="138.72809624808173"
                                                                j="0" val="54"
                                                                barHeight="136.85039999999998"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1704"
                                                                d="M 139.72809624808173 304.11199999999997L 139.72809624808173 202.6728Q 139.72809624808173 197.6728 144.72809624808173 197.6728L 154.8433345031738 197.6728Q 159.8433345031738 197.6728 159.8433345031738 202.6728L 159.8433345031738 202.6728L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 139.72809624808173 304.11199999999997L 139.72809624808173 202.6728Q 139.72809624808173 197.6728 144.72809624808173 197.6728L 154.8433345031738 197.6728Q 159.8433345031738 197.6728 159.8433345031738 202.6728L 159.8433345031738 202.6728L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997z"
                                                                pathFrom="M 139.72809624808173 304.11199999999997L 139.72809624808173 304.11199999999997L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997L 159.8433345031738 304.11199999999997L 139.72809624808173 304.11199999999997"
                                                                cy="197.6728" cx="239.25190649850026"
                                                                j="1" val="42"
                                                                barHeight="106.43919999999999"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1710"
                                                                d="M 240.25190649850026 304.11199999999997L 240.25190649850026 119.042Q 240.25190649850026 114.042 245.25190649850026 114.042L 255.36714475359236 114.042Q 260.36714475359236 114.042 260.36714475359236 119.042L 260.36714475359236 119.042L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 240.25190649850026 304.11199999999997L 240.25190649850026 119.042Q 240.25190649850026 114.042 245.25190649850026 114.042L 255.36714475359236 114.042Q 260.36714475359236 114.042 260.36714475359236 119.042L 260.36714475359236 119.042L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997z"
                                                                pathFrom="M 240.25190649850026 304.11199999999997L 240.25190649850026 304.11199999999997L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997L 260.36714475359236 304.11199999999997L 240.25190649850026 304.11199999999997"
                                                                cy="114.042" cx="339.7757167489188"
                                                                j="2" val="75"
                                                                barHeight="190.06999999999996"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1716"
                                                                d="M 340.7757167489188 304.11199999999997L 340.7757167489188 30.342666666666673Q 340.7757167489188 25.342666666666673 345.7757167489188 25.342666666666673L 355.8909550040109 25.342666666666673Q 360.8909550040109 25.342666666666673 360.8909550040109 30.342666666666673L 360.8909550040109 30.342666666666673L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 340.7757167489188 304.11199999999997L 340.7757167489188 30.342666666666673Q 340.7757167489188 25.342666666666673 345.7757167489188 25.342666666666673L 355.8909550040109 25.342666666666673Q 360.8909550040109 25.342666666666673 360.8909550040109 30.342666666666673L 360.8909550040109 30.342666666666673L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997z"
                                                                pathFrom="M 340.7757167489188 304.11199999999997L 340.7757167489188 304.11199999999997L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997L 360.8909550040109 304.11199999999997L 340.7757167489188 304.11199999999997"
                                                                cy="25.342666666666673" cx="440.29952699933733"
                                                                j="3" val="110"
                                                                barHeight="278.7693333333333"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1722"
                                                                d="M 441.29952699933733 304.11199999999997L 441.29952699933733 250.82386666666665Q 441.29952699933733 245.82386666666665 446.29952699933733 245.82386666666665L 456.4147652544294 245.82386666666665Q 461.4147652544294 245.82386666666665 461.4147652544294 250.82386666666665L 461.4147652544294 250.82386666666665L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 441.29952699933733 304.11199999999997L 441.29952699933733 250.82386666666665Q 441.29952699933733 245.82386666666665 446.29952699933733 245.82386666666665L 456.4147652544294 245.82386666666665Q 461.4147652544294 245.82386666666665 461.4147652544294 250.82386666666665L 461.4147652544294 250.82386666666665L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997z"
                                                                pathFrom="M 441.29952699933733 304.11199999999997L 441.29952699933733 304.11199999999997L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997L 461.4147652544294 304.11199999999997L 441.29952699933733 304.11199999999997"
                                                                cy="245.82386666666665" cx="540.8233372497558"
                                                                j="4" val="23"
                                                                barHeight="58.28813333333332"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1728"
                                                                d="M 541.8233372497558 304.11199999999997L 541.8233372497558 88.6308Q 541.8233372497558 83.6308 546.8233372497558 83.6308L 556.9385755048479 83.6308Q 561.9385755048479 83.6308 561.9385755048479 88.6308L 561.9385755048479 88.6308L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 541.8233372497558 304.11199999999997L 541.8233372497558 88.6308Q 541.8233372497558 83.6308 546.8233372497558 83.6308L 556.9385755048479 83.6308Q 561.9385755048479 83.6308 561.9385755048479 88.6308L 561.9385755048479 88.6308L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997z"
                                                                pathFrom="M 541.8233372497558 304.11199999999997L 541.8233372497558 304.11199999999997L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997L 561.9385755048479 304.11199999999997L 541.8233372497558 304.11199999999997"
                                                                cy="83.6308" cx="641.3471475001743"
                                                                j="5" val="87"
                                                                barHeight="220.48119999999997"
                                                                barWidth="22.115238255092077"></path>
                                                            <path id="SvgjsPath1734"
                                                                d="M 642.3471475001743 304.11199999999997L 642.3471475001743 182.39866666666666Q 642.3471475001743 177.39866666666666 647.3471475001743 177.39866666666666L 657.4623857552664 177.39866666666666Q 662.4623857552664 177.39866666666666 662.4623857552664 182.39866666666666L 662.4623857552664 182.39866666666666L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997z"
                                                                fill="rgba(0,158,247,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0"
                                                                clip-path="url(#gridRectMaskewzf0fcc)"
                                                                pathTo="M 642.3471475001743 304.11199999999997L 642.3471475001743 182.39866666666666Q 642.3471475001743 177.39866666666666 647.3471475001743 177.39866666666666L 657.4623857552664 177.39866666666666Q 662.4623857552664 177.39866666666666 662.4623857552664 182.39866666666666L 662.4623857552664 182.39866666666666L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997z"
                                                                pathFrom="M 642.3471475001743 304.11199999999997L 642.3471475001743 304.11199999999997L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997L 662.4623857552664 304.11199999999997L 642.3471475001743 304.11199999999997"
                                                                cy="177.39866666666666" cx="741.8709577505928"
                                                                j="6" val="50"
                                                                barHeight="126.71333333333331"
                                                                barWidth="22.115238255092077"></path>
                                                            <g id="SvgjsG1696" class="apexcharts-bar-goals-markers"
                                                                style="pointer-events: none">
                                                                <g id="SvgjsG1697"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1703"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1709"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1715"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1721"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1727"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                                <g id="SvgjsG1733"
                                                                    className="apexcharts-bar-goals-groups"></g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1695" class="apexcharts-datalabels"
                                                            data:realIndex="0">
                                                            <g id="SvgjsG1700" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1702"
                                                                    font-family="inherit" x="49.261905125209246"
                                                                    y="155.2616" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="49.261905125209246" cy="155.2616">54</text>
                                                            </g>
                                                            <g id="SvgjsG1706" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1708"
                                                                    font-family="inherit" x="149.78571537562777"
                                                                    y="185.6728" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="149.78571537562777" cy="185.6728">42</text>
                                                            </g>
                                                            <g id="SvgjsG1712" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1714"
                                                                    font-family="inherit" x="250.3095256260463"
                                                                    y="102.042" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="250.3095256260463" cy="102.042">75</text>
                                                            </g>
                                                            <g id="SvgjsG1718" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1720"
                                                                    font-family="inherit" x="350.83333587646484"
                                                                    y="13.342666666666673" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="350.83333587646484"
                                                                    cy="13.342666666666673">110</text></g>
                                                            <g id="SvgjsG1724" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1726"
                                                                    font-family="inherit" x="451.3571461268833"
                                                                    y="233.82386666666662" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="451.3571461268833"
                                                                    cy="233.82386666666662">23</text></g>
                                                            <g id="SvgjsG1730" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1732"
                                                                    font-family="inherit" x="551.8809563773018"
                                                                    y="71.6308" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="551.8809563773018" cy="71.6308">87</text>
                                                            </g>
                                                            <g id="SvgjsG1736" class="apexcharts-data-labels"
                                                                transform="rotate(0)"><text id="SvgjsText1738"
                                                                    font-family="inherit" x="652.4047666277203"
                                                                    y="165.39866666666666" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="13px"
                                                                    font-weight="600" fill="#181c32"
                                                                    class="apexcharts-datalabel"
                                                                    style="font-family: inherit;"
                                                                    cx="652.4047666277203"
                                                                    cy="165.39866666666666">50</text></g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1789" x1="0" y1="0"
                                                        x2="703.6666717529297" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1790" x1="0" y1="0"
                                                        x2="703.6666717529297" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1791" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1792" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1793" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <g id="SvgjsG1762" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(20.333328247070312, 0)">
                                                    <g id="SvgjsG1763" class="apexcharts-yaxis-texts-g"><text
                                                            id="SvgjsText1765" font-family="inherit"
                                                            x="20" y="31.4" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1766">120</tspan>
                                                            <title>120</title>
                                                        </text><text id="SvgjsText1768" font-family="inherit"
                                                            x="20" y="107.428" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1769">90</tspan>
                                                            <title>90</title>
                                                        </text><text id="SvgjsText1771" font-family="inherit"
                                                            x="20" y="183.456" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1772">60</tspan>
                                                            <title>60</title>
                                                        </text><text id="SvgjsText1774" font-family="inherit"
                                                            x="20" y="259.4839999999999" text-anchor="end"
                                                            dominant-baseline="auto" font-size="13px"
                                                            font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1775">30</tspan>
                                                            <title>30</title>
                                                        </text><text id="SvgjsText1777" font-family="inherit"
                                                            x="20" y="335.51199999999994"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="13px" font-weight="400" fill="#a1a5b7"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: inherit;">
                                                            <tspan id="SvgjsTspan1778">0</tspan>
                                                            <title>0</title>
                                                        </text></g>
                                                </g>
                                                <g id="SvgjsG1683" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 187.5px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: inherit; font-size: 12px;"></div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(0, 158, 247);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: inherit; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_32_tab_content_2" role="tabpanel"
                                    aria-labelledby="#kt_charts_widget_32_tab_2">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_32_chart_2" class="min-h-auto"
                                        style="height: 375px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_32_tab_content_3" role="tabpanel"
                                    aria-labelledby="#kt_charts_widget_32_tab_3">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_32_chart_3" class="min-h-auto"
                                        style="height: 375px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 32-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 17-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Most Popular Products</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">8k social visitors</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html"
                                    class="btn btn-sm btn-light">Add Product</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Content-->
                            <div class="d-flex flex-stack my-5">
                                <span class="text-gray-400 fs-7 fw-bold">ITEM</span>
                                <span class="text-gray-400 fw-bold fs-7">ITEM PRICE</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/14.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Fjallraven</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-6437</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 72.00</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/13.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Nike AirMax</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-1836</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 45.00</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/41.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Bose QC 35</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-6254</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 168.00</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/53.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Greeny</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-1746</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 14.50</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/71.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Apple
                                            Watches</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-6245</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 362.00</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/194.gif" class="me-4 w-50px"
                                        alt="">
                                    <!--end::Icon-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="../../demo1/dist/apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Friendly
                                            Robot</a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">Item: #XDG-2347</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">$ 48.00</span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 17-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Tables widget 6-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Leading Agents by Category</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Total 424,567 deliveries</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html"
                                    class="btn btn-sm btn-light">Add Product</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_1" aria-selected="true"
                                        role="tab">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-truck fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Van</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_2"
                                        aria-selected="false" role="tab" tabindex="-1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-truck fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Bike</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_3"
                                        aria-selected="false" role="tab" tabindex="-1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="fonticon-drone fs-1 p-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Drone</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_stats_widget_6_tab_1"
                                    role="tabpanel">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-1.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-2.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-12.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-11.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-13.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_2" role="tabpanel">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-11.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-13.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-1.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-2.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-12.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_3" role="tabpanel">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-1.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-11.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-13.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-12.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="assets/media/avatars/300-2.jpg"
                                                                    class="" alt="">
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-dark fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-400 d-block">Deliveries</span>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>
                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                            <div class="rating-label me-1 checked">
                                                                <i class="bi bi-star-fill fs-6s"></i>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Tables widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 18-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Lading Companies</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">8k social visitors</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <ul class="nav me-n1" id="kt_chart_widget_11_tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                                            data-bs-toggle="tab" id="kt_list_widget_18_tab_1"
                                            href="#kt_list_widget_18_tab_content_1" aria-selected="false"
                                            tabindex="-1" role="tab">2021</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active"
                                            data-bs-toggle="tab" id="kt_list_widget_18_tab_2"
                                            href="#kt_list_widget_18_tab_content_2" aria-selected="true"
                                            role="tab">Month</a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_list_widget_18_tab_content_1" role="tabpanel"
                                    aria-labelledby="#kt_list_widget_18_tab_1">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                class="me-4 w-30px" style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Abstergo
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Video
                                                    Channel</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">1,578</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->4.1%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/balloon.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Barone
                                                    LLC.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Messanger</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->0.2%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/plurk.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Big Kahuna
                                                    Burger</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Network</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">2,047</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->1.9%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/vimeo.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Biffco
                                                    Enterprises</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Network</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">3,458</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->8.3%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/atica.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Abstergo
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Community</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">579</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->2.6%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/telegram-2.svg"
                                                class="me-4 w-30px" style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Binford
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Media</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">2,588</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11" y="18"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(-90 11 18)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->0.4%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_list_widget_18_tab_content_2"
                                    role="tabpanel" aria-labelledby="#kt_list_widget_18_tab_2">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/atica.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Abstergo
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Community</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">579</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->2.6%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/telegram-2.svg"
                                                class="me-4 w-30px" style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Binford
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Media</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">2,588</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11" y="18"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(-90 11 18)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->0.4%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/balloon.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Barone
                                                    LLC.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Messanger</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->0.2%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                class="me-4 w-30px" style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Abstergo
                                                    Ltd.</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Video
                                                    Channel</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">1,578</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->4.1%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/vimeo.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Biffco
                                                    Enterprises</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Network</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">3,458</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->8.3%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="assets/media/svg/brand-logos/plurk.svg" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">Big Kahuna
                                                    Burger</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">Social
                                                    Network</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 fw-bold fs-4 me-3">2,047</span>
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="13" y="6"
                                                                width="13" height="2" rx="1"
                                                                transform="rotate(90 13 6)" fill="currentColor">
                                                            </rect>
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->1.9%
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 18-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Chart widget 17-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Sales Statistics</span>
                                <span class="text-gray-400 pt-2 fw-semibold fs-6">Top Selling Products</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button
                                    class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                    <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.3" x="2" y="2" width="20"
                                                height="20" rx="4" fill="currentColor"></rect>
                                            <rect x="11" y="11" width="2.6" height="2.6"
                                                rx="1.3" fill="currentColor"></rect>
                                            <rect x="15" y="11" width="2.6" height="2.6"
                                                rx="1.3" fill="currentColor"></rect>
                                            <rect x="7" y="11" width="2.6" height="2.6"
                                                rx="1.3" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                    data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Create Invoice</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link flex-stack px-3">Create Payment
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                aria-label="Specify a target name for future usage and reference"
                                                data-kt-initialized="1"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Generate Bill</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                        data-kt-menu-placement="right-end">
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">Subscription</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Plans</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Billing</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Statements</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3">
                                                    <!--begin::Switch-->
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input w-30px h-20px"
                                                            type="checkbox" value="1" checked="checked"
                                                            name="notifications">
                                                        <!--end::Input-->
                                                        <!--end::Label-->
                                                        <span class="form-check-label text-muted fs-6">Recuring</span>
                                                        <!--end::Label-->
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1">
                                        <a href="#" class="menu-link px-3">Settings</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Chart container-->
                            <div id="kt_charts_widget_17_chart" class="w-100 h-400px">
                                <div style="position: relative; height: 100%;">
                                    <div style="position: absolute; width: 738px; height: 400px;">
                                        <div><canvas
                                                style="position: absolute; top: 0px; left: 0px; width: 738px; height: 400px;"
                                                width="922" height="500"></canvas><canvas
                                                style="position: absolute; top: 0px; left: 0px; width: 738px; height: 400px;"
                                                width="922" height="500"></canvas></div>
                                    </div>
                                    <div style="overflow: hidden; width: 738px; height: 400px;"></div>
                                    <div role="alert"
                                        style="z-index: -100000; opacity: 0; position: absolute; top: 0px;"></div>
                                    <div style="position: absolute; pointer-events: none; top: 0px; left: 0px; overflow: hidden; width: 738px; height: 400px;"
                                        role="application"></div>
                                    <div>
                                        <div style="position: absolute; opacity: 1e-7; pointer-events: none;"
                                            role="tooltip">One: 27.03%</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Chart container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 17-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div> --}}


    <div class="py-5" style="font-size:30px ;">
        {{ t_('welcome in dashboard') }}
    </div>

    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    @foreach ( $loaders as $loader )

                    <div class="col-md-4">
                        <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div>
                                            <p class="text-muted fw-medium mt-1 mb-2 fs-4">{{t_($loader?->title)}}</p>
                                            <h4>{{$loader?->count}}</h4>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div style="position: relative;">
                                            <div id="radial-chart-1" style="min-height: 86.7px;">
                                                <div id="apexchartsz1htoduf"
                                                    class="apexcharts-canvas apexchartsz1htoduf apexcharts-theme-light"
                                                    style="width: 58.0875px; height: 86.7px;"><svg id="SvgjsSvg1427"
                                                        width="58.0875" height="86.7"
                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                        xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                        style="background: transparent;">
                                                        <g id="SvgjsG1429" class="apexcharts-inner apexcharts-graphical"
                                                            transform="translate(-17.95625, -12)">
                                                            <defs id="SvgjsDefs1428">
                                                                <clipPath id="gridRectMaskz1htoduf">
                                                                    <rect id="SvgjsRect1431" width="102"
                                                                        height="120" x="-3" y="-1"
                                                                        rx="0" ry="0" opacity="1"
                                                                        stroke-width="0" stroke="none"
                                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="gridRectMarkerMaskz1htoduf">
                                                                    <rect id="SvgjsRect1432" width="100"
                                                                        height="122" x="-2" y="-2"
                                                                        rx="0" ry="0" opacity="1"
                                                                        stroke-width="0" stroke="none"
                                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                            </defs>
                                                            <g id="SvgjsG1433" class="apexcharts-radialbar">
                                                                <g id="SvgjsG1434">
                                                                    <g id="SvgjsG1435" class="apexcharts-tracks">
                                                                        <g id="SvgjsG1436"
                                                                            class="apexcharts-radialbar-track apexcharts-track"
                                                                            rel="1">
                                                                            <path id="apexcharts-radialbarTrack-0"
                                                                                d="M 48 16.919512195121953 A 31.080487804878047 31.080487804878047 0 1 1 47.994575431574326 16.91951266850485"
                                                                                fill="none" fill-opacity="1"
                                                                                stroke="rgba(242,242,242,0.85)"
                                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                                stroke-width="3.07087804878049"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area"
                                                                                data:pathOrig="M 48 16.919512195121953 A 31.080487804878047 31.080487804878047 0 1 1 47.994575431574326 16.91951266850485">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1438">
                                                                        <g id="SvgjsG1442"
                                                                            class="apexcharts-series apexcharts-radial-series"
                                                                            seriesName="seriesx1" rel="1"
                                                                            data:realIndex="0">
                                                                            <path id="SvgjsPath1443"
                                                                                d="M 48 16.919512195121953 A 31.080487804878047 31.080487804878047 0 1 1 18.44069954353868 57.60439892517063"
                                                                                fill="none" fill-opacity="0.85"
                                                                                stroke="rgba(59,93,231,0.85)"
                                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                                stroke-width="3.1658536585365873"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                                data:angle="252" data:value="70"
                                                                                index="0" j="0"
                                                                                data:pathOrig="M 48 16.919512195121953 A 31.080487804878047 31.080487804878047 0 1 1 18.44069954353868 57.60439892517063">
                                                                            </path>
                                                                        </g>
                                                                        <circle id="SvgjsCircle1439"
                                                                            r="24.5450487804878" cx="48"
                                                                            cy="48"
                                                                            class="apexcharts-radialbar-hollow"
                                                                            fill="{{$loader?->color}}"></circle>
                                                                        <g id="SvgjsG1440"
                                                                            class="apexcharts-datalabels-group"
                                                                            transform="translate(0, 0) scale(1)"
                                                                            style="opacity: 1;">
                                                                            <text id="SvgjsText1441"
                                                                                font-family="Helvetica, Arial, sans-serif"
                                                                                x="48" y="53"
                                                                                text-anchor="middle"
                                                                                dominant-baseline="auto"
                                                                                font-size="12px" font-weight="400"
                                                                                fill="#ffffff"
                                                                                class="apexcharts-text apexcharts-datalabel-value"
                                                                                style="font-family: Helvetica, Arial, sans-serif;">{{$loader?->count}}</text>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <line id="SvgjsLine1444" x1="0" y1="0"
                                                                x2="96" y2="0" stroke="#b6b6b6"
                                                                stroke-dasharray="0" stroke-width="1"
                                                                class="apexcharts-ycrosshairs"></line>
                                                            <line id="SvgjsLine1445" x1="0" y1="0"
                                                                x2="96" y2="0" stroke-dasharray="0"
                                                                stroke-width="0"
                                                                class="apexcharts-ycrosshairs-hidden"></line>
                                                        </g>
                                                        <g id="SvgjsG1430" class="apexcharts-annotations"></g>
                                                    </svg>
                                                    <div class="apexcharts-legend"></div>
                                                </div>
                                            </div>
                                            <div class="resize-triggers">
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- </span>عدد الطلبات الكلي</p> --}}
                            </div>
                        </div>


                    </div>
                    @endforeach
                </div>
            </div>
        </div>




        <x-slot name="styles">

        </x-slot>

        <x-slot name="scripts">

            <!--Internal  index js -->
            <script src="{{ asset('dashboard/js/index.js') }}"></script>

        </x-slot>

</x-pages.layout>
