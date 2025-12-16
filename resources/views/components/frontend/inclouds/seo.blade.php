<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<link rel="canonical" href="{{$actual_link}}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta http-equiv="Content-Type" content="text/html;">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="content-language" content="{{get_current_lang()}}">
<meta property="og:url" content="{{$actual_link}}">
<meta property="og:site_name" content="{{ setting('general',"name.{$get_current_lang}")}}">
<meta property="website:published_time" content="2021-2-28T17:57:00+00:00">
<meta property="og:image" content="{{ setting('media',"site_logo")}} ">

<!-- Start SEO Meta TAG -->
<meta name="title" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
<meta name="description" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
<meta name="keywords" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">

<meta name="language" content="{{get_current_lang()}}">
<meta name="author" content="{{setting('media',"site_logo")}}">
<meta property="og:locale" content="{{get_current_lang()}}">

<meta property="og:type" content="Website">
<meta property="og:title" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
<meta property="og:description" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
<meta name="twitter:title" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
<meta name="twitter:description" content="{{setting('media',"site_logo")}} {{isset($pageName)?"| $pageName":""}}">
