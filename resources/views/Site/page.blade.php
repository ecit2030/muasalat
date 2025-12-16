@extends('Site.layouts.app')
@section('title')
    {{$page->title}}
@endsection

@push('styles')
    <style>
        main {
            border: 1px solid #a7a7a7;
        }
    </style>
@endpush

@section('content')
    <div class="policy">
        <div class="container">
            <h3 class="text-center">{{$page->title}}</h3>
            <p class="text-center">
                <img src="{{$page->image_path}}" >
            </p>
            <br>
            <main>
                {!! $page->content !!}
            </main>
        </div>
    </div>
@endsection
