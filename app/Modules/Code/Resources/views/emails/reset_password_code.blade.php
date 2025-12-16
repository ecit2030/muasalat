@component('mail::message')
    <h2>{{$title}}</h2>
    {{$message}}
    {{__('Your verification code is ')}}
    {{ $code }}
@endcomponent
