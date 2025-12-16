@extends('errors.layout',['code' => 404])

@section('title', t_('Error 419'))

@section('code',419)

@section('error')

    <!--begin::Title-->
    <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">{{$exception->getMessage()??t_('bad request')}}</h1>
    <!--end::Title-->
    <!--begin::Text-->
    <div class="fw-semibold fs-6 text-gray-500 mb-7">
        {{('please try again and if you encounter this problem again please contact us')}}
    </div>
    <!--end::Text-->

@endsection

