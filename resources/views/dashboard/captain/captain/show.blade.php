<x-pages.layout :title="t_('captain details ')">
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
                                    @if ($user->is_active)
                                        <x-ui.badge :class="'fs-2'" :value="t_('active')" color="success" />
                                    @else
                                        <x-ui.badge :class="'fs-2'" :value="t_('not active')" color="danger" />
                                    @endif
                                </div>
                            </div>

                            <x-component.image class="data-enlargeable" style="cursor: zoom-in" :value="$user?->getFirstMediaUrl('avatar')" :label="t_('Avatar')" />

                            <div class="row">
                                <x-component.input col_size="6" :value="$user->name" :label="t_('Name')" />
                                <x-component.input col_size="6" :value="$user->phone"  :label="t_('Phone')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="6" :value="$user->email" :label="t_('Email')" />
                                <x-component.input col_size="6" :value="$user->date_of_birth" :label="t_('date of birth')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="4" :value="$user->bank_name" :label="t_('bank name')" />
                                <x-component.input col_size="4" :value="$user->bank_personal_id" :label="t_('bank personal id')" />
                                <x-component.input col_size="4" :value="$user->iban" :label="t_('iban')" />
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <x-component.image class="data-enlargeable" :value="$user?->getFirstMediaUrl('ussid')"  :label="t_('ussid')" />
                                    <x-component.input :value="$user->ussid_number"  :label="t_('ussid number')" />
                                </div>

                                <div class="col-6">
                                    <x-component.image class="data-enlargeable" :value="$user?->getFirstMediaUrl('driverLicense')"  :label="t_('driver license')" />
                                    <x-component.input :value="$user->driver_license_number"  :label="t_('driver license number')" />
                                </div>
                            </div>

                            <div class="row">
                                <x-component.input col_size="4" :value="$user?->vehicleYear?->model->brand->name" :label="t_('vehicle brand')" />

                                <x-component.input col_size="4" :value="$user?->vehicleYear?->model->nameCapacity" :label="t_('vehicle model')" />

                                <x-component.input col_size="4" :value="$user?->vehicleYear?->year" :label="t_('vehicle year')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="4" :value="$user?->vehicle?->vehicle_number" :label="t_('vehicle number')" />
                                <x-component.input col_size="4" :value="$user?->vehicle?->vehicle_letter" :label="t_('vehicle letter')" />
                                <x-component.input col_size="4" :value="$user?->vehicle?->color" :label="t_('vehicle color')" />
                            </div>


                            {{--                                                        <div class="row">--}}
                            {{--                                                            <div class="col-6">--}}
                            {{--                                                                <x-component.image class="data-enlargeable" :value="$user?->vehicle?->getFirstMediaUrl('vehicleEnsurance')" :label="t_('vehicle ensurance')" />--}}
                            {{--                                                                <x-component.input :value="$user?->vehicle?->ensurance_end_date" :label="t_('ensurance end date')" />--}}
                            {{--                                                            </div>--}}

                            {{--                                                            <div class="col-6">--}}
                            {{--                                                                <x-component.image class="data-enlargeable" :value="$user?->vehicle?->getFirstMediaUrl('vehiclePeriodic')" :label="t_('vehicle periodic')" />--}}
                            {{--                                                                <x-component.input :value="$user?->vehicle?->periodic_end_date" :label="t_('periodic end date')" />--}}
                            {{--                                                            </div>--}}
                            {{--                                                        </div>--}}

                            <div class="row">

                                <div class="col-6">
                                    <x-component.image class="data-enlargeable" :value="$user?->vehicle?->getFirstMediaUrl('vehicleEnsurance')" :label="t_('vehicle ensurance')" />
                                    {{--                                                                <x-component.image class="data-enlargeable" :value="$user?->vehicle?->getFirstMediaUrl('vehicleForm')" :label="t_('vehicle form photo')" />--}}
                                </div>

                                <div class="col-6">
                                    <x-component.image class="data-enlargeable" :value="$user?->vehicle?->getFirstMediaUrl('vehicleLicense')"  :label="t_('vehicle license')" />
                                    {{--                                                                <x-component.input :value="$user?->vehicle?->license_end_date" :label="t_('license end date')" />--}}
                                </div>
                            </div>


                            <div class="row">
                                <x-component.image class="data-enlargeable"  col_size="6" :value="$vehicle[0] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image class="data-enlargeable"  col_size="6" :value="$vehicle[1] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image class="data-enlargeable"  col_size="6" :value="$vehicle[2] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                                <x-component.image class="data-enlargeable"  col_size="6" :value="$vehicle[3] ?? ''" name="vehicle[]" :label="t_('vehicle photo')" />
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->
    @push('scripts')
    <script>

$('.data-enlargeable').click(function() {
  var src = $(this).attr('src');
  console.log(src)
  var modal;

  function removeModal() {
    modal.remove();
    $('body').off('keyup.modal-close');
  }
  modal = $('<div>').css({
    background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
    backgroundSize: 'contain',
    width: '100%',
    height: '100%',
    position: 'fixed',
    zIndex: '10000',
    top: '0',
    left: '0',
    cursor: 'zoom-out'
  }).click(function() {
    removeModal();
  }).appendTo('body');
  //handling ESC
  $('body').on('keyup.modal-close', function(e) {
    if (e.key === 'Escape') {
      removeModal();
    }
  });
});
    </script>
@endpush
</x-pages.layout>

<style>
    .data-enlargeable {
        cursor: zoom-in;
    }
</style>


