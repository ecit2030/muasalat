<x-pages.layout :title="t_('driver details')">
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

                            <x-component.image :value="$user?->getFirstMediaUrl('avatar')" :label="t_('Avatar')" />

                            <div class="row">
                                <x-component.input col_size="6" :value="$user->name" :label="t_('Name')" />
                                <x-component.input col_size="6" :value="$user->phone"  :label="t_('Phone')" />
                            </div>

                            <div class="row">
                                <x-component.input col_size="6" :value="$user->email" :label="t_('Email')" />
                                <x-component.input col_size="6" :value="$user->date_of_birth" :label="t_('date of birth')" />
                            </div>

                            {{-- <div class="row">
                                <x-component.input col_size="4" :value="$user->bank_name" :label="t_('bank name')" />
                                <x-component.input col_size="4" :value="$user->bank_personal_id" :label="t_('bank personal id')" />
                                <x-component.input col_size="4" :value="$user->iban" :label="t_('iban')" />
                            </div> --}}

                            <div class="row">
                                <div class="col-6">
                                    <x-component.image :value="$user?->getFirstMediaUrl('ussid')"  :label="t_('ussid')" />
                                    <x-component.input :value="$user->ussid_number"  :label="t_('ussid number')" />
                                </div>

                                <div class="col-6">
                                    <x-component.image :value="$user?->getFirstMediaUrl('driverLicense')"  :label="t_('driver license')" />
                                    <x-component.input :value="$user->driver_license_number"  :label="t_('driver license number')" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
