@props(['title','mapping'=> null,'route','create'=>false,'createTitle'=>false,'create_type'=>'','settings'=>false,'datatable','parameters'=>[]])
@extends('dashboard.layouts.default')
@section('title',$title)
@push('styles')
    @if(session('language.rtl'))
        <link href="{{ asset('dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('dashboard/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    @endif
    {{ $styles ?? '' }}
@endpush
@section('content')
    {{ $prepend ?? '' }}

    {{$slot}}

    @if ($mapping)

        <div class="fs-2 text-white-50 p-3 " dir="ltr">{{ $mapping }}</div>

    @endif

    <div class="card border-top border-warning ">
        <div class="card-body overflow-auto">
            <div class="table-responsive">
                {{$datatable->table(['class'=>'table table-hover table-rounded table-striped border gy-7 gs-7 datatable-ajax'])}}
            </div>
        </div>
    </div>
    {{ $append ?? '' }}
@endsection
@section('actions')
    <div class="d-flex flex-shrink-0">
        {{$actions??""}}
        @if($create)
            <a href="{{route("{$route}.create",$parameters)}}"
               @if($create_type === 'modal')
               data-bs-toggle="modal"
               data-bs-target='#modal-form'
               @endif
               class="btn btn-sm btn-primary mx-2 px-5">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z"
                          fill="currentColor"/>
                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z"
                          fill="currentColor"/>
                </svg> {{ t_('Create') }}  {{$createTitle?:''}}
            </a>
        @endif
        @if($settings)

            <a href="#" class='btn btn-sm btn-secondary' data-bs-toggle="modal" data-bs-target='#setting_modal_form'>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                          d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                          fill="currentColor"></path>
                    <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                          fill="currentColor"></path>
                </svg>
                {{  t_('Settings')  }}
            </a>
        @endif

    </div>
@endsection

@section('filters')
    @isset($filters)
        {!! $filters !!}
    @endif
@endsection

@push('styles')
    <style>
        .disabled {
            pointer-events: none;
            user-select: none
        }
    </style>
@endpush


@push('scripts')

    <script>
        $("[form='crud-modal-form']").on("click", function(e) {
            $("[form='crud-modal-form']").addClass("disabled");
        });
    </script>

    <script src="{{ asset('dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

    <script src="{{ asset('dashboard/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{ asset('dashboard/helper.js') }}"></script>

    {{ $datatable->scripts() }}
    <script>
        window.routes = '{{ route($route.'.index') }}/';
    </script>
    {{ $scripts ?? '' }}

@endpush
