@props(['name' => '', 'type' => 'text', 'value' => null, 'label' => null, 'class' => '', 'icon' => null, 'iconClass' => null, 'info' => null, 'col_size' => 12, 'label_class' => '', 'selected' => null, 'additional' => null])
@php
    $invalidClass = $errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $splitAttributes = explode(' ', $attributes);
    $defaultPlaceHolder = t_('enter') . ' ' . t_(':name', ['name' => $label]);
    $properties = [
        'class' => "{$invalidClass} form-control {$class}",
        'placeholder' => $defaultPlaceHolder,
        ...$splitAttributes,
    ];
@endphp

<div @class(["col-sm-$col_size", 'my-6'])>
    <div class="form-group row no-gutters">
        @if ($label)
            <label
                class="d-flex align-items-center fs-5 fw-semibold {{ $label_class }} {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
                <span class="{{ data_get($attributes, 'required') ? 'required' : '' }} form-label">
                    {{ $label }}</span>
                @if ($info)
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                        data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="{{ $info }}"></i>
                @endif
            </label>

        @endif

        <div class="col-sm-12 mb-1   @if ($icon) input-group @endif">

            @if ($icon)
                <span class="input-group-text">{!! $icon !!}</span>
            @endif

            @if ($iconClass)
                <span class="input-group-text"><i class="{{ $iconClass }}"></i></span>
            @endif

            <div class="d-flex justify-content-center gap-3 align-items-center">

                @if (in_array($type, ['radio']))
                    {!! Form::$type($name, $value, $selected) !!}
                @elseif(!in_array($type, ['file', 'password', 'radio']))
                    {!! Form::$type($name, $value, $properties) !!}
                @else
                    {!! Form::$type($name, $properties) !!}
                @endif

                @if ($additional)
                    <span>{{ $additional }}</span>
                @endif

            </div>

            {{ $slot }}
            @error(dotted_string($name))
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


    </div>
</div>
