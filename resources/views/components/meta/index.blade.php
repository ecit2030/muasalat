@aware([])

<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
@php
    $langCode = $session_get('language.code');
    $generalName = setting('general', "name.{$langCode}", setting('general', 'name', config('app.name')));
    $siteName = is_array($generalName) ? ($generalName[$langCode] ?? reset($generalName) ?? config('app.name')) : $generalName;

    $generalDescription = setting('general', "description.{$langCode}", setting('general', 'description', ''));
    $siteDescription = is_array($generalDescription) ? ($generalDescription[$langCode] ?? reset($generalDescription) ?? '') : $generalDescription;
@endphp
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="canonical" href="{{$actual_link}}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta http-equiv="Content-Type" content="text/html;">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="content-language" content="{{get_current_lang()}}">


<!-- Start SEO Meta TAG -->
<meta property="og:url" content="{{$actual_link}}">
<meta property="og:site_name" content="{{ $siteName }}"/>
<meta property="website:published_time" content="2022-2-28T17:57:00+00:00">
<meta property="og:image" content="{{setting('media','dark_dashboard_logo.url',asset('dashboard/media/logos/favicon.ico'))}}">
<meta name="title" content="{{ $siteName }}">
<meta name="description" content="{{ $siteDescription }}"/>
<meta name="keywords" content="{{ $siteDescription ?: $siteName }}"/>
<meta name="language" content="{{get_current_lang()}}">
<meta name="author" content="{{setting('general',"author",config('app.name'))}}">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
<meta property="og:type" content="Website">
<meta property="og:title" content="{{ $siteName }}"/>
<meta property="og:description" content="{{ $siteDescription }}"/>
<meta property="twitter:title" content="{{ $siteName }}"/>
<meta property="twitter:description" content="{{ $siteDescription }}"/>

