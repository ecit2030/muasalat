@props(['title' => '', 'id' => '', 'route' => '', 'rightBreadcrumb' => ''])
@extends('dashboard.layouts.default')


@section('title', t_('view :title', ['title' => $title]))


@push('styles')
    <link rel="stylesheet" href="{{ asset('/dashboard/vendors/sweetalert/sweetalert.css') }}">

    {{ $styles ?? '' }}
@endpush

@section('breadcrumb-right')
    <h4 class="content-title mb-0 my-auto">
        {{ t_('View :title', ['title' => $title]) }}</h4>
    {{ $rightBreadcrumb ?? '' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div id="{{ $id ?? $title . '-show' }}" class="card-body">

                    <div class="">
                        {{ $slot }}
                    </div>

                </div>
                <!-- row -->
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@push('scripts')
    <!--Internal Fancy uploader js-->
    <script src="{{ asset('dashboard/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>



    <script>
        window.routes = '{{ route($route . '.index') }}/';
    </script>
    <script src="{{ asset('dashboard/helper.js') }}"></script>

    {{ $scripts ?? '' }}
@endpush
