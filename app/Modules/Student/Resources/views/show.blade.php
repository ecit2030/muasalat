@extends('layouts.app')

@section('styles')
    <!-- INTERNAL Rating css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/rating/css/examples.css') }}">

    <!-- INTERNAl Themes  css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/rating/dist/themes/css-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/rating/dist/themes/bootstrap-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/rating/dist/themes/fontawesome-stars-o.css') }}">

    <!-- INTERNAL Fullcalendar css-->
    <link href='{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}' rel='stylesheet' />
    <link href='{{ asset('assets/plugins/fullcalendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
@endsection

@section('content')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">المستخدمين </h4>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="card">
        <div class="row g-0">
            <div class="col-lg-12 col-xl-12">
                <div class="">
                    <div class="main-content-body main-content-body-contacts">
                        <div class="main-contact-info-header bg-contacthead">
                            <div class="media">
                                <div class="main-img-user brround">
                                    <img alt="" src="{{ $client->image_path }}" class="w-100 h-100 br-7">
                                    <a href=""><i class="fe fe-camera"></i></a>
                                </div>
                                <div class="media-body text-white">
                                    <h4 class="text-white">{{ $client->first_name . ' ' . $client->last_name }}</h4>
                                    <p class="">{{ '' }}</p>
                                    <nav class="nav contact-icons">
                                        <a role="button" class="btn text-white bg-white-50 me-2 mb-2 ms-2"
                                            href="javascript:void(0);"><i class="fe fe-dollar-sign"></i> {{ $client->wallet }} </a>
                                    </nav>
                                </div>
                            </div>
                            <div class="main-contact-action">
                                <a href="" class="btn btn-success">تعديل</a>
                                <a href="" class="btn btn-danger">حذف</a>
                            </div>
                        </div>
                        <div class="main-contact-info-body">
                            <div class="card-body">
                                <h6 class="text-primary">نبذة</h6>
                                <p class="text-muted">
                                    {!! $client->bio !!}
                                </p>
                            </div>
                            <div class="media-list p-0">
                                <div class="media py-4 mt-0">
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <div class="media-icon bg-primary-transparent border-primary me-3 mt-1">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div>
                                                <label>رقم الهاتف</label>
                                                <span class="font-weight-normal1 fs-14">{{ $client->phone }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="media-icon bg-primary-transparent border-primary me-3 mt-1">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div>
                                                <label>البريد الإلكتروني</label>
                                                <span class="font-weight-normal1 fs-14">{{ $client->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media py-4 border-top mt-0">
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <div class="media-icon bg-primary-transparent border-primary me-3 mt-1">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div>
                                                <label>المدينه \ الجنسية</label>
                                                <span class="font-weight-normal1 fs-14">
                                                    {{ $client->city->name . ' / ' . $client->nationality->name }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->




    <!-- Row -->
    <div class="row	">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="card-body">
                        <nav class="nav main-nav-column main-nav-calendar-event mb-2" id="external-events-list">
                            <a class="nav-link d-flex mb-2 p-2 br-3 bg-primary-transparent fc-event"
                                data-class="bg-primary-transparent" href="">
                                <span class="p-1 bg-primary ms-2 me-3 br-3"></span>
                                <div>مواعيد الكورسات</div>
                            </a>
                            <a class="nav-link d-flex mb-2 p-2 bg-success-transparent br-3 fc-event"
                                data-class="bg-success-transparent" href="">
                                <span class="p-1 bg-success ms-2 me-3 br-3"></span>
                                <div>مواعيد المقررات</div>
                            </a>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="" id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    @include('client::modals')
@endsection('content')

@section('scripts')
    <!--INTERNAL  Contact js -->
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    <!-- INTERNAL Rating js-->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    <script src="{{ asset('assets/plugins/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/plugins/rating/js/examples.js') }}"></script>


    <!-- INTERNAL Full-calendar js-->
    <script src='{{ asset('assets/plugins/fullcalendar/moment.min.js') }}'></script>
    <script src='{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}'></script>
    {{-- <script src="{{ asset('assets/js/app-calendar.js') }}"></script> --}}
    @include('client::calendar')
@endsection
