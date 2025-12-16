<!-- BEGIN VENDOR JS-->
<script>
    var translations = {!! file_exists(lang_path('/').get_current_lang().'.json') ? file_get_contents(lang_path('/').get_current_lang().'.json')  : "" !!};

    function trans(Key) {
        var key = Key.toLowerCase();
        // var trans = JSON.parse(translations);
        return (translations[key] != null ? translations[key] : key);
    }
</script>

<!--begin::Javascript-->
<script>var hostUrl = "dashboard/";</script>

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('dashboard/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dashboard/js/scripts.bundle.js') }}"></script>

<!-- custom js -->
<script src="{{asset('dashboard/js/customs.js')}}"></script>

<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->

@include('sweetalert::alert')

<script src="//unpkg.com/alpinejs" defer></script>

<!-- /core JS files -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
    });
</script>
<script src="{{asset('dashboard/plugins/toastr/toastr.min.js')}}"></script>

@stack('scripts')

