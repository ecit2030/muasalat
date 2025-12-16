<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    @include('Site.layouts.alert')
    @include('Site.layouts.header')
    @yield('content')
    @include('Site.layouts.footer')
</html>
