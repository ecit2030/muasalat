@props([ 'href','name','description'=>null, 'icon'=>'panorama_fish_eye', 'label'=>'', 'class'=>'', ])

@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
     $class="{$invalidClass} nav-link w-100 btn btn-flex btn-active-light-success validate {$class}";
$data_error=".errorTxt2";
@endphp

<li class="nav-item w-100 me-0 mb-md-2 {{ $invalidClass }}" data-error=" {{ $data_error }} ">
    <a class="{{ $class }} "
       data-bs-toggle="tab"
       href="#{{$href}}">
        <!--begin::Svg Icon | path: icons/duotune/general/gen001.svg-->
        <span class="svg-icon svg-icon-2 svg-icon-primary me-3">
            {!!  $icon ? "<i class='fa {$icon}'></i>":'' !!}
        </span>
        <!--end::Svg Icon-->
        <span class="d-flex flex-column align-items-start">
            <span class="fs-6 fw-bold">{{$name}}</span>
            <span class="fs-7">{{$description}}</span>
        </span>
    </a>
</li>
