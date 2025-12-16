<x-form route="dashboard.general.areas" :title="t_($title)">


    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach



    <x-form.toggle type="checkbox" name="active" :label="t_('Active')" />

    <x-form.input :value="$parent_id" hidden name="parent_id" />

    <div class="row">
        <x-form.input col_size="6" name="title[en]" :value="$model?->getTranslation('title', 'en')" :label="t_('address in english')" />

        <x-form.input col_size="6" name="title[ar]" :value="$model?->getTranslation('title', 'ar')" :label="t_('address in arabic')" />
    </div>





    <div class="row">
        <div class="col-md-3">
            <x-form.image name="flag" :label="t_('flag')" />
        </div>
        <div class="col-md-9">
            <x-form.map :model="$model" />
        </div>
    </div>




</x-form>
