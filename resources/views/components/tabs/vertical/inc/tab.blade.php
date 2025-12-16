@props(['href','route','key'=>null,'saveData'=>true,'class'=>'','parameters'=>[]])

<div @class(["tab-pane",$class]) id="{{$href}}" role="tabpanel" aria-labelledby="{{$href}}-tab">

    <div id="{{ $id ?? $href.'-tab-form' }}">
        @if($saveData)
            {!! Form::open([ 'id'=>"{$href}-form",'name'=>"$href","novalidate"=>"novalidate",'route' => [$route, "#{$href}"], 'files'=>true])!!}
        @endif

        {{ $slot }}

        <div class="card-footer">
            @if($saveData)
                <x-form.action :form_id='"{$href}-form"' :route="$route" backRoute="dashboard.home"/>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
</div>