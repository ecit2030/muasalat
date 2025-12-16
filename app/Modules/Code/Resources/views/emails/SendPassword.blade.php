@component('mail::message')
    {{$message}}
    {{__('Your verification code is ')}}
    {{ $password }}
@endcomponent
