<head>
    <base href="{{url('/')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title') | {{setting('general',"name.{$session_get('language.code')}",config('app.name'))}}</title>
    <!-- Meta -->
    <link rel="shortcut icon" href="{{setting('media','white_fav_icon.url',asset('site/images/logo2.png'))}}"/>
    {{-- <link rel="shortcut icon" href="{{setting('media','white_fav_icon.url',asset('dashboard/media/logos/favicon.ico'))}}"/> --}}
    <x-meta/>

    @if(session('language.rtl'))

        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400&amp;display=swap" rel="stylesheet">

        <link href="{{ asset('dashboard/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('dashboard/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('dashboard/plugins/global/plugins-custom.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>

    @else

    <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <!--end::Fonts-->

        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{asset('dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('dashboard/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->

    @endif
    <link href="{{ asset('dashboard/plugins/toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>

    @stack('styles')

    <link href="{{asset('dashboard/custom.css')}}" rel="stylesheet">

</head>
