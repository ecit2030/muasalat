@props(['name', 'type' => 'text', 'value' => null, 'label' => null, 'class' => '', 'icon' => null, 'iconClass' => null, 'info' => null, 'col_size' => 12, 'label_class' => ''])
@php
    $invalidClass = $errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $splitAttributes = explode(' ', $attributes);
    $defaultPlaceHolder = t_("enter"). " " . t_(':name', ['name' => $label]);
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

            <div class="row ">

                <div class="col overflow-hidden" style="height:120px">
                    <x-form.image :name="$name" :value="$value"   />
                </div>

                <div class="col d-flex align-self-center">
                    @if ($value)
                        <audio controls>
                            <source src="{{ $value }}" type="audio/mpeg">
                        </audio>
                    @endif

                </div>
            </div>

            {{ $slot }}
            @error(dotted_string($name))
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


    </div>
</div>
