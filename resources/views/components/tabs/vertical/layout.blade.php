@props(['key'=>null,'saveData'=>true,'title','description'=>'','parameters'=>[]])

@extends('dashboard.layouts.default')


@section('title',$title)


@push('styles')

    {{ $styles ?? '' }}

@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header card-header-stretch">

                    <div class="card-title">
                        {{$title}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row rounded border p-10">
                        <ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 min-w-lg-200px">
                            {{ $links ?? '' }}
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{ $tabs}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    {{ $scripts ?? '' }}
@endpush
