@php($style = setting('style') )
@if(isset($style))
    <style>
        .hover {
            cursor: pointer;

        }

        .hover:hover {
            color: gold !important;

        }

    </style>


    <div class="  nav-item main-header-notification">

        <label style=""
               class="active hover nav-link new nav-link @isset($style['dark_mode']) {{$style['dark_mode']? 'text-primary':''}}  @endisset  fa fa-cloud-moon"
               for="dark_mode">

            <input name="dark_mode" type="checkbox" class="dark-mode-checkbox"
                   id="dark_mode" value="dark_mode"
                   @isset($style['dark_mode']) {{$style['dark_mode']? 'checked':''}}  @endisset hidden/>

        </label>
     </div>

@endif

@push('scripts')

    <script>
        (function ($) {
            "use strict";

            $(document).on('change', '.dark-mode-checkbox', function (event) {
                event.preventDefault();
                var Type = $(this).attr('value');
                console.log(Type);
                if (Type) {
                    dark_mode(Type);
                }
            });

            function dark_mode(Type) {
                $.ajax({
                    url: "{{route("dashboard.setting.style_submit")}}",
                    type: 'post',
                    data: {
                        type: Type,
                    },
                    success: function (res) {
                        if (res.success) {
                            toastr_success(res.message)
                            $('body').toggleClass('dark-theme');
                        }
                    }
                });
            }
        })(jQuery);
    </script>


@endpush
