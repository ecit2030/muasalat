<!-- Section footer start -->
<footer class="footer">
    <div class="container bottom_border">
        <div class="footer-links">
            {{-- <ul class="justify-content-between d-flex align-items-center list-unstyled">

                @foreach ($staticpages as $staticpage)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ url('/') . '/' . app()->getLocale() }}#section-{{ $staticpage->name }}"
                            @if (!Request::is('/')) onclick='location.href="{{ url('/') . '/' . app()->getLocale() }}#section-{{ $staticpage->name }}";' @endif>@lang($staticpage->name)</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') . '/' . app()->getLocale() }}#section-contact-us"
                        @if (!Request::is('/')) onclick='location.href="{{ url('/') . '/' . app()->getLocale() }}#section-contact-us";' @endif>@lang('Contact Us')</a>
                </li>
            </ul> --}}
        </div>
    </div>
    <div class="container">
        <p class="text-center mt-3">@lang('Copyright') <span id="y"></span> | @lang('Designed With by') <a
                href="https://moltaqa.net" target="_blank" style="color:#fff;font-size:15px;">@lang('Moltaqa For Online Store Design')</a></p>
        {{-- <ul class=" list-unstyled mt-5">
          <li>
            <a href="tel:{{app_settings()->phone}}"><i class="fa fa-phone"></i>{{app_settings()->phone}}</li></a>
          <li>
        <a href="mailto:{{app_settings()->email}}"><i class="fa fa fa-envelope"></i>{{app_settings()->email}}</li> </a>
  		</ul> --}}
        <ul class="social_footer_ul">
            @foreach ([] as $site_contact)
                <li><a href="{{ $site_contact->value }}"><i
                            class="fab fa-{{ strtolower($site_contact->class) }}"></i></a></li>
            @endforeach
        </ul>
    </div>
</footer>
<!-- Section footer end -->

<!-- SCRIPTS -->
<script type="text/javascript" src={{ asset('site/js/jquery-3.6.0.min.js') }}></script>
<script type="text/javascript" src={{ asset('site/js/all.min.js') }}></script>
<script type="text/javascript" src={{ asset('site/js/bootstrap.min.js') }}></script>
<script type="text/javascript" src={{ asset('site/js/owl.carousel.min.js') }}></script>
<script type="text/javascript" src={{ asset('site/js/wow.min.js') }}></script>
<script type="text/javascript" src={{ asset('site/js/main.js') }}></script>
<script src={{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js') }}></script>
<script>
    document.getElementById("y").innerHTML = new Date().getFullYear();

    function AlertMe(type = 'success', message) {
        if (message != undefined) {
            toastr[type]("", message, {
                timeOut: 5000,
                closeButton: true,
                positionClass: "toast-bottom-left",
            });
        }
    }
</script>
@if (session()->has('success'))
    <script>
        AlertMe('success', "{{ session()->get('success') }}");
    </script>
@endif
@if (session()->has('error'))
    <script>
        AlertMe('error', "{{ session()->get('error') }}");
    </script>
@endif
<script>
    $('.nav-link').on('click', function() {
        var link = $(this).attr('href');
        if (link == window.location.href) {
            $('.nav-item').removeClass('active');
            $(this).parent().addClass('active');
        }
    })
</script>
@yield('scripts')
</body>
