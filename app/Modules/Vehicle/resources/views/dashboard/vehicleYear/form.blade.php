<x-form route="modules.vehicle.dashboard.vehicle-year" :title="t_('vehicle year')"
 :indexId='$model?->vehicle_model_id ?? request("vehicle_model_id")' indexNameId="vehicle_model_id" >
    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.input name="vehicle_model_id" class="d-none" :value='request("vehicle_model_id")'/>

    <x-form.input name="year" :label="t_('year')" />

</x-form>
