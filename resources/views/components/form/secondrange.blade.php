@props(['name','label' , "from" => null ,"to" => null  ])
<div class="row my-6 ">
    <div class="col-12 col-md-6">
        <x-form.input :name="$name.'[from]'"
                      {{ $attributes }} :label="__ (':label From',['label'=>$label])"
                      :value="$from"/>
    </div>
    <div class="col-12 col-md-6">
        <x-form.input :name="$name.'[to]'"
                      {{ $attributes }} :label="__ (':label To',['label'=>$label])"
                      :value="$to"/>
    </div>
</div>
