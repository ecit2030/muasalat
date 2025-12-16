@props(['title'=>'Layout Page' ])
@extends('dashboard.layouts.default',['attributes' => $attributes ])
@section('title',$title)
@push('styles')
    {{ $styles ?? '' }}
@endpush
@section('content')
    {{ $prepend ?? '' }}
    {{ $slot  }}
    {{ $append ?? '' }}
@endsection
@section('filters')
    {{ $filters ?? ""  }}
@endsection
@section('after_actions')
    {{ $after_actions ?? ""  }}
@endsection
@section('actions')
    {{ $actions ?? ""  }}
@endsection
@push('scripts')
    {{ $scripts ?? '' }}
@endpush
