@aware(['indexId' => null ,"backRoute" => null, "indexNameId" => null ,'route','title','id','saveData'=>true,'class'=>'','js-validator'=>null,'files'=>true,'parameters'=>[]])
@extends('dashboard.layouts.default')

@php
$routesList = is_array($route) ? $route : null;
$model = Form::getModel();
$title = $model ? t_("edit") . " ". t_(":title",['title'=>$title]) : t_("create") . " ". t_(':title',['title'=>$title]);
@endphp


@section('title',$title)

@push('styles')
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{asset(" dashboard/plugins/telephoneinput/telephoneinput.css")}}">
<link rel="stylesheet" href="{{asset('dashboard/vendors/sweetalert/sweetalert.css')}}">
{{ $styles ?? '' }}
@endpush

@section('breadcrumb')
<h4 class="content-title mb-0 my-auto">
    {{$model ? t_("edit"). " ".t_(":title", ['title'=>$title]) : t_("create"). " ".t_(':title', ['title'=>$title])}}</h4>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card border-top border-info">

            <div id="{{ $id ?? $title.'-form' }}" class="card-body ">
                @if($model)
                {!! Form::model(
                $model,
                [
                'id'=>'crud-modal-form',
                'route' => $routesList['update'] ?? [$route.'.update', $model->{$model->getKeyName()}],
                'method'=>'PUT','files'=>$files
                ]
                )!!}
                @else
                {!! Form::open([ 'id'=>'crud-modal-form','route' => $routesList['create']?? $route.'.store',
                'files'=>true])!!}
                @endif
                <div class="{{$class ?? "
                "}}">
                {{ $slot }}
            </div>
        </div>
        {!! Form::close() !!}

        <!-- row -->
    </div>
</div>
</div>
<!-- row closed -->

@endsection


@section('actions')
@if($saveData)
<x-form.action :route="$route" :indexId="$indexId" :indexNameId="$indexNameId" :backRoute="$backRoute"/>
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
    //    $("[form='crud-modal-form']").on("click", function(e) {
    //        $("[form='crud-modal-form']").addClass("disabled");
    //    });
    document.getElementById('crud-modal-form').addEventListener('submit', function (event) {
        // Check if all required inputs are filled
        var allInputsFilled = checkRequiredInputs();

        // If any required input is not filled, prevent form submission and disable the button
        if (!allInputsFilled) {
            event.preventDefault();
            $("[form='crud-modal-form']").addClass("disabled");
        } else {
            // If all required inputs are filled, you can choose to re-enable the button here
            $("[form='crud-modal-form']").removeClass("disabled");
        }
    });

    function checkRequiredInputs() {
        var requiredInputs = document.querySelectorAll('[required]');
        var allInputsFilled = true;

        requiredInputs.forEach(function (input) {
            if (!input.value.trim()) {
                allInputsFilled = false;
            }
        });

        return allInputsFilled;
    }

    // Add event listeners to re-enable the submit button when required inputs are filled
    var requiredInputs = document.querySelectorAll('[required]');
    requiredInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            if (!checkRequiredInputs()) {
                $("[form='crud-modal-form']").addClass("disabled");
            }
            else{
                $("[form='crud-modal-form']").removeClass("disabled");
            }
        });
    });
</script>

<script src="{{ asset('dashboard/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@isset($jsValidator)
{!! JsValidator::formRequest($jsValidator)->ignore($jsValidatorIgnore??'') !!}
@endisset
<!-- Internal TelephoneInput js-->
<script src="{{asset('dashboard/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{asset('dashboard/plugins/telephoneinput/inttelephoneinput.js')}}"></script>

<script src="{{ asset('dashboard/helper.js') }}"></script>

{{ $scripts ?? '' }}
@endpush
