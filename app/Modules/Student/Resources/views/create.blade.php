@extends('layouts.app')

@section('styles')
    <!-- INTERNAl Forn-wizard css-->
    <link href="{{ asset('assets/plugins/forn-wizard/css/forn-wizard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/formwizard/smart_wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/formwizard/smart_wizard_theme_dots.css') }}" rel="stylesheet">

    <!-- INTERNAL File Uploads css -->
    <link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

    <!-- INTERNAL File Uploads css-->
    <link href="{{ asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection


@section('content')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">إضافة مستخدم</h4>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <x-form.form title="إضافة مستخدم" method="post" action="{{ route('admin.clients.store') }}">
        <!--Row-->
        <x-form.input id="first_name" name='first_name' value="{{ old('first_name') }}" title="الاسم الاول" />
        <x-form.input id="last_name" name='last_name' value="{{ old('last_name') }}" title="الاسم الاخير" />

        <x-form.select2 name="city_id" placeholder="المحافظه" multiple="{{ false }}">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </x-form.select2>

        <x-form.select2 name="nationality_id" placeholder="الجنسية" multiple="{{ false }}">
            @foreach ($nationalities as $nationality)
                <option value="{{ $nationality->id }}"
                    {{ old('nationality_id') == $nationality->id ? 'selected' : '' }}>
                    {{ $nationality->name }}
                </option>
            @endforeach
        </x-form.select2>

        <x-form.select2 name="gender" placeholder="الجنس" multiple="{{ false }}">
            @foreach ([1, 2] as $gender)
                <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                    {{ \Modules\Provider\Entities\Provider::genderName($gender) }}
                </option>
            @endforeach
        </x-form.select2>

        <x-form.input id="email" name='email' type="email" value="{{ old('email') }}"
            title="البريد الإلكتروني" />

        <x-form.input id="phone" name='phone' type="tel" value="{{ old('phone') }}"
        title="رقم الهاتف" />

        <x-form.input id="birth_date" name='birth_date' type="date" value="{{ old('birth_date') }}"
        title="تاريخ الميلاد" />



        <x-form.input id="password" name='password' type="password" title="كلمة المرور" />
        
        <div class="col-lg-4 col-sm-12">
            <x-form.file id="image" name='image'  title="صورة" />
        </div>

        <button type="submit" class="btn btn-primary mt-4 mb-0">حفظ</button>
    </x-form.form>
    <!-- /Row -->
@endsection('content')


@section('scripts')
    <!-- INTERNAl Jquery.steps js -->
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

    <!-- INTERNAl Forn-wizard js-->
    <script src="{{ asset('assets/plugins/formwizard/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('assets/plugins/formwizard/fromwizard.js') }}"></script>

    <!-- INTERNAl Accordion-Wizard-Form js-->
    <script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard2.js') }}"></script>


    <!-- INTERNAL File uploads js -->
    <script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/filupload.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
