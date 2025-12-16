@component('mail::message')
    {{$message}}
    {{__('Your verification code is ')}}
    {{ $code }}
@endcomponent
