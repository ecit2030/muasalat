@extends('Site.layouts.app')
@section('content')
    @php
        $general = setting('general');
    @endphp

    @include('Site.layouts.alert')

    <div class="header" id="section-home">
        <div class="header-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="header-img wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.5s"
                        style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <img src="{{ asset('site/images/muasla-image.png') }}" width="80%" alt="hero">
                    </div>
                </div>
                {{-- <div class="col-sm-5">
                    <div class="header-img wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.5s">
                        <img src="{{ asset('') }}" alt="hero">
                    </div>
                </div> --}}
                <div class="col-sm-7">
                    <div class="header-info">
                        <h1 class="header-title wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.6s">{{data_get($general, 'name.'.get_current_lang())}}</h1>
                        <div class="header-desc wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.7s">{{data_get($general, 'description.'.get_current_lang())}}</div>
                    </div>
                    <div class="download-btns wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.8s">
                        @if (data_get($general, 'ios_link'))
                            <a href="{{ data_get($general, 'ios_link') }}"><i class="fab fa-apple"></i>@lang('App Store')</a>
                        @endif
                        @if (data_get($general, 'android_link'))
                            <a href="{{ data_get($general, 'android_link') }}"> <i
                                    class="fab fa-google-play"></i>@lang('Google Play')</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($staticpages as $staticpage)
        <div class="adding-section" id="section-{{ $staticpage->getTranslation('title', 'en') }}">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="header-img wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.5s"
                            style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <img src="{{ asset('site/images/muasla-image.png') }}" width="80%" alt="hero">
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="adding-sec-img wow fadeInLeft" data-wow-duration="0.6s" data-wow-delay="0.6s">
                            <img src="{{ asset('adminpanel/assets/images/default1.jpg') }}" alt="">
                        </div>
                    </div> --}}
                    <div class="col-md-7">
                        <div class="adding-sec-info">
                            <h6 class="wow fadeInRight" data-wow-duration="0.6s" data-wow-delay="0.6s">


                                {{ $staticpage->getTranslation('title', get_current_lang()) }}</h6>
                            <p class="wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.8s">
                                {!! $staticpage->content[get_current_lang()] !!}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="download" id="section-contact-us">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="download-img wow fadeInLeft" data-wow-duration="0.6s" data-wow-delay="0.6s">
                        <img src="{{ asset('adminpanel/assets/images/default1.jpg') }}" alt="">
                    </div>
                </div>

                <div style="z-index:9">
                    @foreach ($errorss ?? [] as $error)
                        <div class="text-danger fs-3"> {{ $error }} *</div>
                    @endforeach
                </div>

                <div class="col-md-7">
                    <div class="download-info">
                        <div class="contact-us-form">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">

                                        <form class="form-taws" method="post"
                                            action="{{ route('frontend.contactUsLanding') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="{{ __('name') }}" value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="text-danger"
                                                            style="color: #FF8F30 !important;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="number" name="phone" class="form-control"
                                                        placeholder="{{ __('phone') }}" value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <span class="text-danger"
                                                            style="color: #FF8F30 !important;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="{{ __('email') }}" value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="text-danger"
                                                            style="color: #FF8F30 !important;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <textarea name="message" placeholder="{{ __('message') }}">{{ old('message') }}</textarea>
                                                    @error('message')
                                                        <span class="text-danger"
                                                            style="color: #FF8F30 !important;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary send_contact"
                                                value="{{ __('Send') }}">
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@include('dashboard.layouts.includes.scripts')
