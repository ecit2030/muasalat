@props(['indexId' => null, "indexNameId"=>null , 'id' => 'submit', 'form_id' => 'crud-modal-form', 'readOnly' => false, 'submit_name' => 'Save changes', 'backRoute' => null, 'class' => '', 'route', 'parameters' => []])

@php
    $splitAttributes = explode(' ', $attributes);
    $properties = [
        'class' => "btn btn-sm btn-icon btn-active-color-success {$class}",
        'data-error' => '.errorTxt2',
        'id' => $id,
        'type' => 'submit',
        ...$splitAttributes,
    ];
    $routesList = is_array($route) ? $route : null;
@endphp
<!--begin::Actions-->
<div class="d-flex flex-shrink-0">


    @if (!$readOnly)
        <button form="{{ $form_id }}" type="submit" class="btn btn-success mx-2 px-5">
            <i class="fa fa-save"></i> {{ t_('save data') }}
        </button>
    @endif

    {{ $betweenActions ?? '' }}


    @if ($indexNameId && $indexId)
        <a href="{{ route($route . '.index', $indexNameId."=". $indexId) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> {{ t_('go back') }}
        </a>
    @elseif ( $indexId)
        <a href="{{ route($route . '.index', "id=". $indexId) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> {{ t_('go back') }}
        </a>
    @else
        <a href="{{ route($backRoute ?? ($routesList['index'] ?? $route . '.index'), $parameters) }}"
            class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> {{ t_('go back') }}
        </a>
    @endif




</div>
<!--end::Actions-->
