<x-form route="modules.vehicle.dashboard.vehicle-request" :title="t_('vehicle request')">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.input name="content" :label="t_('content')" />

    @if(!empty($statuses))
        <x-form.select col_size="4" name="status" :options="$statuses" id="status" :label="t_('status')" />
    @endif

</x-form>
