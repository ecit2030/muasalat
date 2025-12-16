<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
  <meta name="Author" content="{{setting('general','author')}}">
  <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
  <title>@yield('title') | {{setting('general','name.'.get_current_lang())}}</title>
  <!-- Favicon -->
  <link rel="icon" href="{{setting('media','white_fav_icon.url')}}" type="image/x-icon"/>

  <!-- Icons css -->
  <link href="{{asset('dashboard/css/icons.css')}}" rel="stylesheet">

  <!--  Right-sidemenu css -->
  <link href="{{asset('dashboard/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

  <!-- Sidemenu css -->
  <link rel="stylesheet" href="{{asset('dashboard/css-rtl/closed-sidemenu.css')}}">

  <!--  Custom Scroll bar-->
  <link href="{{asset('dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>

  <!--  Left-Sidebar css -->
  <link rel="stylesheet" href="{{asset('dashboard/css/sidemenu.css')}}">

  <!--- Style css --->
  <link href="{{asset('dashboard/css-rtl/style.css')}}" rel="stylesheet">

  <!--- Dark-mode css --->
  <link href="{{asset('dashboard/css-rtl/style-dark.css')}}" rel="stylesheet">

  <!---Skinmodes css-->
  <link href="{{asset('dashboard/css-rtl/skin-modes.css')}}" rel="stylesheet"/>

  <!--- Animations css-->
  <link href="{{asset('dashboard/css/animate.css')}}" rel="stylesheet">

</head>
<body class="main-body bg-light">

<!-- Loader -->
<div id="global-loader">
  <img src="{{asset('dashboard/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

  <div class="container-fluid">
    @yield('content')
  </div>

</div>
<!-- End Page -->

<!-- JQuery min js -->
<script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Bundle js -->
<script src="{{asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Ionicons js -->
<script src="{{asset('dashboard/plugins/ionicons/ionicons.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('dashboard/plugins/moment/moment.js')}}"></script>

<!-- eva-icons js -->
<script src="{{asset('dashboard/js/eva-icons.min.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('dashboard/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('dashboard/plugins/rating/jquery.barrating.js')}}"></script>

<!-- custom js -->
<script src="{{asset('dashboard/js/customs.js')}}"></script>

</body>
</html>