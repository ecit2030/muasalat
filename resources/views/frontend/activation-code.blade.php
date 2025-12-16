<x-frontend.layouts>

@isset($actionUrl,$method)
    <!-- Body Content -->
        <div class="py-10 my-3 box-bodycontent usersignup-section">
            <div class="container">
                <!-- HEAD -->
                <div class="position-relative">
                    <nav data-aos="fade-left" data-aos-once="true" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-secondary-dark" href="{{url('/')}}"> {{t_('home')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">                           {{t_('activation_code')}}
                            </li>
                        </ol>
                    </nav>

                    <section class="section-head text-center mt-xl-n12">
                        <h4 class="mb-3" data-aos="zoom-in" data-aos-once="true">
                            {{t_('activation_code')}}
                        </h4>
                        <span class="title-line l1 bg-primary"></span>
                        <span class="title-line l2 bg-warning"></span>
                    </section>


                    <img data-aos-once="true" data-aos="fade-down" src="{{asset('site/assets/img/rect-gray.svg')}}" alt="rect"
                         class="position-absolute end-0 top-0 zindex" width="80">
                </div>

                <!-- BODY -->
                <div class="row g-xxl-12 g-8 bodycontent-wrap">
                    <div class="col-lg-7 align-self-center">
                        <form action="{{$actionUrl}}" method="{{$method}}" class="form-blacktext-wrap  border py-8 rounded-3">
                            <!-- Intro Text -->
                            <div class="mb-5">
                                <h4 class="fw-bold text-secondary-dark">اهلا بك</h4>
                                <hr>
                                <small class="text-center text-danger">
                                    {{session('activation.code')}}
                                </small>
                            </div>

                            <!-- Inputs -->
                            <div class="mb-5">
                                <input type="text" name="code" class="form-control text-black display-omd py-3"
                                       placeholder="كود التحقق">

                            </div>
                            @if(session('failed'))
                                <small class="alert alert-danger">
                                    {{session('failed')}}
                                </small>
                        @endif

                        <!-- Sumbit Button -->
                            <div class="mt-10 mb-5 submit-button">
                                <button type="submit"
                                        class="shadow btn btn-primary py-3 display-omd mx-auto rounded-3 bg-btn-hover white-hover">تأكيد
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="" class="mb-0 display-omd fw-bold">
                                    {{t_('resend the code')}}
                                </a>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-5">

                        <div class="text-center">
                            <img src="{{asset('site/assets/img/illustrations/usersignup.svg')}}"
                                 class="img-fluid mt-10 w-xxl-80 illustrate-img" alt="تسجيل الدخول">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endisset

    <x-slot name="js">

        <script src="{{asset('site/js/customer/main.js')}}"></script>

    </x-slot>

</x-frontend.layouts>

