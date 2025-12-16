<div class="row">


    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <div class="col-lg-12 mb-10">
        <div class="card border-top border-bottom border-gray-500 shadow-xs">

            <div class="card-body">
                <ul class="nav nav-pills nav-pills-custom mb-3">

                    @forelse($languages as $k => $lang)

                        <li class="nav-item mb-3 me-3 me-lg-6 @error('*.'.$lang->code) border-error @enderror" id="tap_link_{{$lang->code}}">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden
                                w-80px h-85px pt-5 pb-2 link_{{$lang->code}} {{$lang->code == get_current_lang() ? "active":""}}"
                               id="kt_stats_widget_16_tab_link_1"
                               data-bs-toggle="pill"
                               href="#tab_{{$lang->code}}">
                                <!--begin::Icon-->
                                <div class="nav-icon mb-3">

                                    <img src=" {{ asset($lang->flag) }} "
                                         style="width: 20px;">
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ $lang->name }}</span>
                                <!--end::Title-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>

                    @empty
                        <li class="nav-item">
                            {{ t_('Dont_Found_Any_Language') }}
                        </li>
                    @endforelse
                </ul>
                <div class="tab-content" id="myTabContent">

                    @forelse($languages as $lang)

                        <div class="tab-pane fade show  {{ $lang->code == get_current_lang() ? 'active' : '' }}"
                             id="tab_{{ $lang->code }}" role="tabpanel" aria-labelledby="language">

                            <div class="row">

                                <x-form.input col_size="6" :value='data_get($general,"name.{$lang->code}","site name {$lang->code}")'
                                              icon="<i class='fas fa-file-signature'></i>"
                                              :label="t_('site name')" name="general[name][{{ $lang->code }}]"/>

                                <x-form.input col_size="6" :value='data_get($general,"description.{$lang->code}","site description {$lang->code}")'
                                              icon="<i class='fas fa-search-location'></i>"
                                              :label="t_('site description')" name="general[description][{{ $lang->code }}]"/>

                                <x-form.input col_size="6" :value='data_get($general,"copyright.{$lang->code}","site copyright {$lang->code}")'
                                              icon="<i class='fas fa-search-location'></i>"
                                              :label="t_('site copyright')" name="general[copyright][{{ $lang->code }}]"/>

                            </div>



                        </div>
                    @empty
                        <div class="nav-item">
                            {{ t_('Dont_Found_Any_Language') }}
                        </div>
                    @endforelse

                    <div class="row">

                        <x-form.input col_size="6" additional="%" :value='data_get($general,"tax" , 14)'
                                      icon="<i class='fas fa-file-signature'></i>"
                                      :label="t_('tax percentage')" name="general[tax]"/>

                        <x-form.input col_size="6" additional="%" :value='data_get($general,"appPercentage" , 10)'
                                        icon="<i class='fas fa-file-signature'></i>"
                                        :label="t_('app Percentage')" name="general[appPercentage]"/>

                        <x-form.input col_size="6" :additional="t_('km')" :value='data_get($general,"searchRange" , 1)'
                                      icon="<i class='fas fa-search-location'></i>"
                                      :label="t_('search range')" name="general[searchRange]"/>

                        <x-form.input col_size="6" :additional="t_('minute')" :value='data_get($general,"timeRange" , 30)'
                                      icon="<i class='fa fa-clock'></i>"
                                      :label="t_('time range')" name="general[timeRange]"/>

                        <x-form.input col_size="6" additional="{{t_('minute')}}" :value='data_get($general,"captain_accept_reject_time" , 5)'
                                      icon="<i class='fa fa-clock'></i>"
                                      label="{{__('messages.captain_accept_reject_time')}}" name="general[captain_accept_reject_time]"/>

                        <x-form.input col_size="6" additional="{{t_('minute')}}" :value='data_get($general,"client_trip_payment_time_before_cancel" , 5)'
                                      icon="<i class='fa fa-clock'></i>"
                                      label="{{__('messages.client_trip_payment_time_before_cancel')}}" name="general[client_trip_payment_time_before_cancel]"/>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <x-form.input col_size="6" :value="data_get($general, 'phone', '+966508755187')" dir="ltr" :label="t_('phone')" name="general[phone]"/>
    <x-form.input col_size="6" :value="data_get($general, 'email', 'admin@gmail.com')" dir="ltr" :label="t_('email')" name="general[email]"/>
    <x-form.input col_size="6" :value="data_get($general, 'website', 'example.com')" dir="ltr" :label="t_('website')" name="general[website]"/>
    <x-form.input col_size="6" :value="data_get($general, 'author', 'administrator')" :label="t_('author')" name="general[author]"/>
    <x-form.input col_size="6" :value="data_get($general, 'app_version_number', '1.0.0')" dir="ltr" :label="t_('app version')"
                  name="general[app_version_number]"/>

    <x-form.input col_size="6" :value="data_get($general, 'android_link', 'https://sss.example.com')" dir="ltr" :label="t_('android link')"
                  name="general[android_link]"/>

    <x-form.input col_size="6" :value="data_get($general, 'ios_link', 'https://ios.example.com')" dir="ltr" :label="t_('ios link')"
                  name="general[ios_link]"/>

    <div class="col-12" id="TimeZone"></div>

</div>

@push('scripts')

    <script type="text/javascript">
        setTimeout(function () {
            $('#TimeZone').timezonePicker({
                hoverText: function (e, data) {
                    return (data.timezone + " (" + data.zonename + ")");
                },
                defaultValue: {
                    value: "{{ data_get($general, 'timezone','Asia/Riyadh') }}",
                    attribute: "timezone"
                },
                selectClass: "select-timezone",

                quickLink: [{
                    "Riyadh": "Asia/Riyadh",
                    "Cairo": "Africa/Cairo"
                }]
            });
            $('.select-timezone').attr("name", "general[timezone]");
        }, 1000)
    </script>

    <!--Internal  index js -->

    <script src="{{ asset('dashboard/plugins/pickers/timezone/dist/timezone-picker.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pickers/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>

    <script>
        (function ($) {

            "use strict";


            //Colorpicker for email header
            $('#header_color').colorpicker();

            $('#header_color').on('colorpickerChange', function (event) {
                $('.header_color .fa-square').css('color', event.color.toString());
            });

            //Colorpicker for email footer
            $('#footer_color').colorpicker();

            $('#footer_color').on('colorpickerChange', function (event) {
                $('.footer_color .fa-square').css('color', event.color.toString());
            });

            $('form').each(function () {
                if ($(this).data('validator'))
                    $(this).data('validator').settings.ignore = ".note-editor *";
            });

        })(jQuery);
    </script>

@endpush
