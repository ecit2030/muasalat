<x-form route="modules.vehicle.dashboard.vehicle-brand" :title="t_('vehicle brand')">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.input name="name[en]" :value='$model?->getTranslation("name" , "en")' :label="t_('name in english')" />
    <x-form.input name="name[ar]" :value='$model?->getTranslation("name" , "ar")' :label="t_('name in arabic')" />

</x-form>
