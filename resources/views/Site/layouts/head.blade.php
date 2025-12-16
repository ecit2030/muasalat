<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{setting('general','name.'.get_current_lang())}}</title>
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('site/images/logo2.png') }}" /> --}}
    <link rel="shortcut icon" href="{{setting('media','white_fav_icon.url',asset('site/images/logo2.png'))}}"/>

    <base href="{{ asset('assets') }}/">
    <link rel="stylesheet" href={{ asset('site/css/all.min.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/animate.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/owl.theme.default.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/main.css') }}>
    <link rel="stylesheet" href={{ asset('site/css/toastr.min.css') }}>
    <link href="{{ asset('dashboard/plugins/toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>

    <script src="{{ asset("site/js/toastr.min.js") }}"></script>


    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Cairo', sans-serif;
        }
        svg.svg-inline--fa.mr-3 {
            height: 2.5em !important;
        }
        .navbar {
            background: linear-gradient( 45deg ,#fff 0%,#052775 100%);
        }
        footer{
            font-weight: bold;
            color: #fff;
        }
        .header-overlay{
            background: linear-gradient( 45deg ,#85A8E5 0%,#1f57c8 100%);
        }
        .header a{
            color:#052775;
        }
        .header a:hover {
            background: linear-gradient( 45deg ,#052775 0%,#1f57c8 100%);
            color: #fff;
        }
        footer{
            background: #052775;
            height: auto;
            min-height: unset;
        }
        .download::before {

    background: -webkit-linear-gradient( 45deg ,#85A8E5 0%,#1f57c8 100%);
    background: -o-linear-gradient( 45deg ,#85A8E5 0%,#1f57c8 100%);
    background: linear-gradient( 45deg ,#85A8E5 0%,#1f57c8 100%);
        }
     .contact-us-form .send_contact {
    background: linear-gradient( 45deg ,#052775 0%,#1f57c8 100%);;
        }
        .header .header-info {

    padding-top: 25px;
}
.adding-section h6 {
    font-size: 30px;
}
.adding-sec-info{
    text-align: right;
}
.adding-section,.adding-section:nth-child(odd){
    padding:150px 20px;
}
    </style>
        @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href={{ asset('site/css/main-ar.css') }}>
        <style>
           .download-btns .header a{
            height:150px;

            }
               .navbar {
            background: linear-gradient( 45deg ,#052775 0% ,#fff 100%);
        }
        .header a{
            display:inline-block;
            width:150px;
        }

        </style>




    @endif
    @yield('styles')
</head>
