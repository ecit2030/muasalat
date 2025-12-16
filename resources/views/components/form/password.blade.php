@props(['name','confirmation_name'=>null,'placeholder'=>'password','col_size'=>'6','confirm'=>true,'hint'=>null,'class'])
@php

    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
@endphp

<div class="row my-6">
    <div class="mb-5 col-md-{{$col_size}}">
        <!--begin::Main wrapper-->
        <div class="fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2 {{ $errors->has($name) ? 'text-danger' : '' }}">
                    {{t_($placeholder ?? '')}}
                </label>
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">

                    {!!
                    Form::password($name,[
                        'class'=>"form-control form-control-lg  $invalidClass ".
                        ($class ?? ''),
                        'placeholder'=>t_($placeholder ?? ''),
                    ])
                    !!}
                    {{-- @error(dotted_string($name))
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                          data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>

                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>

                <!--end::Input wrapper-->

                <!--begin::Highlight meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Highlight meter-->
            </div>
            <!--end::Wrapper-->

            @if($hint)
                <!--begin::Hint-->
                <div class="text-muted">
                    {{$hint}}
                </div>
                <!--end::Hint-->
            @endif
        </div>
        <!--end::Main wrapper-->
    </div>
    @if($confirm)
        <div class="mb-5 col-md-{{$col_size}}">
            <div class="fv-row" data-kt-password-meter="true">
                <!--begin::Wrapper-->
                <div class="mb-1">
                    <!--begin::Label-->
                    <label class="form-label fw-semibold fs-6 mb-2 {{ $errors->has($name) ? 'text-danger' : '' }}">
                        {{t_(($placeholder ?? '') . " confirmation")}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Input wrapper-->
                    <div class="position-relative mb-3">

                        {!!
                        Form::password($confirmation_name ?? "{$name}_confirmation",[
                            'class'=>"form-control form-control-lg  $invalidClass ".
                        ($class ?? ''),
                            'placeholder'=>t_(($placeholder ?? '') ." confirmation"),
                        ])
                        !!}
                        {{-- @error(dotted_string($name))
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                        <!--begin::Visibility toggle-->
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                              data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>

                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                        <!--end::Visibility toggle-->
                    </div>

                    <!--end::Input wrapper-->

                    <!--begin::Highlight meter-->
                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                    <!--end::Highlight meter-->
                </div>
                <!--end::Wrapper-->
                @if($hint)
                    <!--begin::Hint-->
                    <div class="text-muted">
                        {{$hint}}
                    </div>
                    <!--end::Hint-->
                @endif
            </div>
        </div>
    @endif
</div>
