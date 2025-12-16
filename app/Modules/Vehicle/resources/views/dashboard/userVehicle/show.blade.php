<x-pages.layout :title="t_('vehicle details ')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">

                        <div class="invoice-header">

                            <h1 class="invoice-title">{{ t_('information about') }}</h1>

                            <div class="billed-from">
                                <div class="d-flex justify-center gap-3 pt-5" style="font-size:30px">
                                    @if ($model->is_active)
                                    <x-ui.badge :class="'fs-2'" :value="t_('active')" color="success" />
                                    @else
                                    <x-ui.badge :class="'fs-2'" :value="t_('not active')" color="danger" />
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <x-component.input col_size="4" :value="$model->year->model->brand->name" :label="t_('vehicle brand')" />

                                <x-component.input col_size="4" :value="$model->year->model->nameCapacity" :label="t_('vehicle model')" />

                                <x-component.input col_size="4" :value="$model->year->year" :label="t_('vehicle year')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="4"  :value="$model->vehicle_number" type="number" :label="t_('vehicle number')" />
                                <x-component.input col_size="4"  :value="$model->vehicle_letter" :label="t_('vehicle letter')" />
                                <x-component.input col_size="4"  :value="$model->color" :label="t_('color')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="4" :value="$model->license_end_date" :label="t_('license end date')" />
                                <x-component.input col_size="4" :value="$model->ensurance_end_date" :label="t_('ensurance end date')" />
                                <x-component.input col_size="4" :value="$model->periodic_end_date" :label="t_('periodic end date')" />
                            </div>

                            <div class="row">
                                <x-component.image col_size="3" :value="$model->getFirstMediaUrl('vehicleForm')" :label="t_('vehicle form')" />
                                <x-component.image col_size="3" :value="$model->getFirstMediaUrl('vehicleLicense')" :label="t_('vehicle license')" />
                                <x-component.image col_size="3" :value="$model->getFirstMediaUrl('vehicleEnsurance')" :label="t_('vehicle ensurance')" />
                                <x-component.image col_size="3" :value="$model->getFirstMediaUrl('vehiclePeriodic')" :label="t_('vehicle periodic')" />
                            </div>

                            <div class="row">
                                <x-component.image col_size="3" :value="$vehicle[0] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image col_size="3" :value="$vehicle[1] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image col_size="3" :value="$vehicle[2] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image col_size="3" :value="$vehicle[3] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
