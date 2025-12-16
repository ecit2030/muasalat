@if (Session::has('success'))
    <div class="alert alert-success alert-styled-left" style="z-index:999999999">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        {{ Session::get('success') }}
    </div>
@endif

@php
    Session::forget('success');
@endphp


@if (Session::has('error'))
    <div class="alert alert-danger alert-styled-left d-block">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                class="sr-only">Close</span></button>
        {{ Session::get('error') }}
    </div>
@endif
