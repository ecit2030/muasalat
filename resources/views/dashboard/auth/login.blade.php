@extends('dashboard.auth.layout')

{{-- page title --}}
@section('title',t_('User Login'))

{{-- page content --}}
@section('content')


    <!--begin::Form-->
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard.home') }}"
                  data-kt-action="{{ route('dashboard.login') }}">
            @csrf
            <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">{{t_('sign in')}}</h1>
                    <!--end::Title-->

                </div>
                <!--begin::Heading-->

                <!--begin::Separator-->
                <div class="separator separator-content my-14">
                    <span class="w-125px text-gray-500 fw-semibold fs-7">{{t_('by email')}}</span>
                </div>
                <!--end::Separator-->

                <div class="fv-row mb-8">
                    <x-form.input name="email" type="email" class="bg-transparent" :label="t_('email')"/>
                </div>

                <div class="fv-row mb-3">
                    <x-form.password col_size="12" :confirm="false" type="password" name="password" class="bg-transparent" :label="t_('password')"/>
                </div>

                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">

                        <span class="indicator-label">{{t_('sign In')}}</span>

                        <span class="indicator-progress">{{t_('please_wait')}}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Form-->

@endsection
