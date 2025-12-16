@if($done)
    <x-ui.badge value="{{$title}}" color="success"/>
@else
    <x-ui.badge value="{{$title}}" color="danger"/>

@endif

