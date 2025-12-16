<x-form route="modules.vehicle.dashboard.vehicle-model" :title="t_('vehicle model')"
:indexId='$model?->vehicle_brand_id ?? request("vehicle_brand_id")' indexNameId="vehicle_brand_id" >

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.input name="vehicle_brand_id" class="d-none" :value='request("vehicle_brand_id")'/>

    <x-form.input name="name[en]" :value='$model?->getTranslation("name" , "en")' :label="t_('name in english')" />

    <x-form.input name="name[ar]" :value='$model?->getTranslation("name" , "ar")' :label="t_('name in arabic')" />

    <x-form.input name="capacity" :value='$model?->capacity' :label="t_('capacity')" />

</x-form>
