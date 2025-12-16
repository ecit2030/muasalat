@props(['id'=>'','name', 'value'=>1,'col_size'=>6, 'label'=>'', 'class'=>'','checked' ])
@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $splitAttributes = explode(' ',$attributes);
    $id = 'toggle_'.dotted_string($name)."_".$id;
    $properties = [
    'class'=>"{$invalidClass} form-check-input {$class}" ,
    ...$splitAttributes,
    'id'=>$id
    ];
        $checked ??= (int) data_get(Form::getModel(),dotted_string($name)) == 1;
@endphp

<div @class(["col-sm-{$col_size}",'form-check form-switch form-check-custom form-check-solid my-6'])>

    <label class="form-check-label p-2 {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}" for="{{ $id }}">
        {{ $label }}
    </label>
    <input type="hidden" name="{{ $name }}" value="0">
    {!! Form::checkbox($name,$value,$checked,$properties) !!}
    @error(dotted_string($name))
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

