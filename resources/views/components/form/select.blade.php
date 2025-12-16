@props(['name', 'id' => null, 'options' => null, 'label' => null, 'class' => '', 'icon' => null, 'ajaxRoute' => null, 'selected' => null, 'multiple' => null, 'label_class' => null, 'info' => null, 'col_size' => 12, 'errorName' => null])
@php
    $errorName ??= dotted_string($name);
    $splitAttributes = explode(' ', $attributes);
    $invalidClass = $errors->has($errorName) ? 'is-invalid' : '';
    $defaultPlaceHolder = !$multiple ? t_('Select') . ' ' . "$label" : t_('Select') . ' ' . "$label";

    $properties = [
        'class' => "{$invalidClass} form-select rounded-start-0 {$class}",
        'data-placeholder' => $defaultPlaceHolder,
        'id' => $id ?? Str::remove(['[', ']'], $name),
        ...$splitAttributes,
        'multiple' => $multiple,
    ];
    !$multiple && ($options = \Arr::prepend($options, '', ''));

@endphp

<div @class(["col-sm-$col_size", 'my-6'])>
    @if ($label)
        <label
            class="form-label d-flex align-items-center fs-5 fw-semibold {{ $label_class }} {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
            <span class="{{ data_get($attributes, 'required') ? 'required' : '' }} form-label">
                {{ $label }}</span>
            @if ($info)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="{{ $info }}"></i>
            @endif
        </label>
    @endif
    <div class="input-group flex-nowrap">
        @if ($icon)
            <span class="input-group-text">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <div class="overflow-hidden flex-grow-1">
            {!! !$slot->isEmpty() ? $slot : Form::select($name, $options, $selected, $properties) !!}

            @error($errorName)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var options = {
            width: "100%",
            allowClear: true,
        };
    </script>
    @if ($ajaxRoute)
        <script>
            options['ajax'] = {
                url: "{{ route($ajaxRoute) }}",
                dataType: 'json',
                delay: 250,
                processResults: function(res) {
                    return {
                        results: $.map(res, function(item, index) {
                            return {
                                text: item,
                                id: index
                            }
                        })
                    };
                },
                cache: true
            };
        </script>
    @endif
    <script>
        (function($) {
            "use strict";
            $('#{{ data_get($properties, 'id') }}').select2(options);
        })(jQuery);
    </script>
@endpush
