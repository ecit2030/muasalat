<x-form route="dashboard.captain.captain" :title="t_('captain')">

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')" />
    <x-form.image name="avatar" :value="$avatar" :label="t_('Avatar')" />
    <div class="row">
        <x-form.input col_size="6" name="name" :label="t_('Name')" />
        <x-form.input col_size="6" name="phone" pattern="^(05)\d{8}$" :value="$phone" type="text"
            :label="t_('Phone')" />
    </div>

    <div class="row">
        <x-form.input col_size="6" name="email" type="email" :label="t_('Email')" />
        <x-form.input col_size="6" name="date_of_birth" type="date" :label="t_('date of birth')" />
    </div>

    <div class="row">
        <x-form.input col_size="4" name="bank_name" :label="t_('bank name')" />
        <x-form.input col_size="4" name="bank_personal_id" type="number" :label="t_('bank personal id')" />
        <x-form.input col_size="4" name="iban" :label="t_('iban')" />
    </div>


    <div class="row">
        <x-form.password col_size="6" name="password" type="password" :label="t_('Password')"/>
    </div>

    <div class="row align-items-end">

        <div class="col-4">
            <x-form.image name="ussid" :value="$ussid" :label="t_('ussid')" />
            <x-form.input name="ussid_number" :value="$ussidNumber" type="number" :label="t_('ussid number')" />
        </div>

        <div class="col-4">
            <x-form.image name="driver_license" :value="$driverLicense" :label="t_('driver license')" />
            <x-form.input name="driver_license_number" :value="$driverLicenseNumber" type="number" :label="t_('driver license number')" />
        </div>
        <x-form.input col_size="4" name="driver_license_end_date" type="date" :value="$driverLicenseEndDate" :label="t_('driver license end date')" />
    </div>

    <div class="row">
        <x-form.select col_size="4" name="vehicle_brand_id" :options="$vehicleBrand" :selected="$selectedVehicleBrand"
            id="vehicle_brand_id" :label="t_('vehicle brand')" />

        <x-form.select col_size="4" name="vehicle_model_id" :options="$vehicleModel" :selected="$selectedVehicleModel"
            id="vehicle_model_id" :label="t_('vehicle model')" />

        <x-form.select col_size="4" name="vehicle_year_id" :options="$vehicleYear" :selected="$selectedVehicleYear" id="vehicle_year_id"
            :label="t_('vehicle year')" />
    </div>


        <div class="row">
            <x-form.select col_size="4" name="vehicle_letter_right" :options="$letters" :selected="$selectedLetterRight" id="vehicle_letter_right" :label="t_('vehicle letter right')" />
            <x-form.select col_size="4" name="vehicle_letter_middle" :options="$letters" :selected="$selectedLetterMiddle" id="vehicle_letter_middle" :label="t_('vehicle letter middle')" />
            <x-form.select col_size="4" name="vehicle_letter_left" :options="$letters" :selected="$selectedLetterLeft" id="vehicle_letter_left" :label="t_('vehicle letter left')" />
            <x-form.input col_size="4" name="sequence_number" :value="$vehicleSequenceNumber" type="number" min="00000000" max="9999999999" :label="t_('vehicle sequence number')" />
            <x-form.input col_size="4" name="vehicle_number" :value="$vehicleNumber" type="number" max="9999" :label="t_('vehicle number')" />
            <x-form.input col_size="4" name="color" :value="$model?->color" :label="t_('color')" />
        </div>


    <div class="row">
        <div class="col-6">
            <x-form.image name="vehicle_ensurance" :value="$vehicleEnsurance" :label="t_('vehicle ensurance')" />
{{--            <x-form.input name="ensurance_end_date" :value="$ensuranceEndDate"--}}
{{--                min="{{ date_format(new DateTime('tomorrow'), 'Y-m-d') }}" max="2030-12-30" type="date"--}}
{{--                :label="t_('ensurance end date')" />--}}
        </div>

{{--        <div class="col-6">--}}
{{--            <x-form.image name="vehicle_periodic" :value="$vehiclePeriodic" :label="t_('vehicle periodic')" />--}}
{{--            <x-form.input name="periodic_end_date" :value="$periodicEndDate"--}}
{{--                min="{{ date_format(new DateTime('tomorrow'), 'Y-m-d') }}" max="2030-12-30" type="date"--}}
{{--                :label="t_('periodic end date')" />--}}
{{--        </div>--}}
    </div>

    <div class="row">

{{--        <div class="col-6">--}}
{{--            <x-form.image name="vehicle_form" :value="$vehicleForm" :label="t_('vehicle form photo')" />--}}
{{--        </div>--}}

        <div class="col-6">
            <x-form.image name="vehicle_license" :value="$vehicleLicense" :label="t_('vehicle license')" />
{{--            <x-form.input name="license_end_date" min="{{ date_format(new DateTime('tomorrow'), 'Y-m-d') }}"--}}
{{--                max="2030-12-30" :value="$licenseEndDate" type="date" :label="t_('license end date')" />--}}
        </div>
    </div>


    <div class="row">
        @if (isset($vehicle))
            <div class="row">
                <x-form.image :multiple="true" col_size="6" :value="$vehicle[0] ?? ''" name="vehicle[]"
                    :label="t_('vehicle photo')" />
                <x-form.image :multiple="true" col_size="6" :value="$vehicle[1] ?? ''" name="vehicle[]"
                    :label="t_('vehicle photo')" />
                <x-form.image :multiple="true" col_size="6" :value="$vehicle[2] ?? ''" name="vehicle[]"
                    :label="t_('vehicle photo')" />
                <x-form.image :multiple="true" col_size="6" :value="$vehicle[3] ?? ''" name="vehicle[]"
                    :label="t_('vehicle photo')" />
            </div>
        @else
            <x-form.image :multiple="true" col_size="6" name="vehicle[]" :label="t_('vehicle photo')" />
        @endif
    </div>

</x-form>
<div id="shadow" class="d-none  position-fixed w-100 h-100 d-flex justify-content-center align-items-center">
    <div class=" lds-facebook">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

@push('styles')
    <style>
        #shadow {
            background: transparent;
            z-index: 9999999999999;
        }

        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            z-index: 15;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: #fff;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $("#vehicle_brand_id").on("change", (x) => {
            id = x.target.value;
            $("#shadow").toggleClass("d-none");
            $.ajax({
                url: `{{ route('dashboard.user-vehicle-model.ajax.get') }}`,
                type: "Post",
                dataType: 'JSON',
                data: {
                    "id": `${id}`
                },
                success: function(res) {
                    data = [...res.data];
                    $("#shadow").toggleClass("d-none");
                    $("#vehicle_model_id").children().remove()
                    $("#vehicle_model_id").append(
                        `<option value="">{{ t_('Please Choose a Model') }}<option/>`)
                    $("#vehicle_year_id").children().remove()
                    $("#vehicle_year_id").append(
                        `<option value="">{{ t_('Please Choose a Year') }}<option/>`)
                    data.forEach(el => {
                        $("#vehicle_model_id").append(
                            `<option value="${el.id}">${el.name}<option/>`)
                    });
                }
            });
        });
        $("#vehicle_model_id").on("change", (x) => {
            id = x.target.value;
            capacity = x.target;
            $("#shadow").toggleClass("d-none");
            $.ajax({
                url: `{{ route('dashboard.user-vehicle-year.ajax.get') }}`,
                type: "Post",
                dataType: 'JSON',
                data: {
                    "id": `${id}`
                },
                success: function(res) {
                    data = [...res.data];
                    $("#shadow").toggleClass("d-none");
                    $("#vehicle_year_id").children().remove()
                    $("#vehicle_year_id").append(
                        `<option value="">{{ t_('Please Choose a Year') }}<option/>`)
                    data.forEach(el => {
                        $("#vehicle_year_id").append(
                            `<option value="${el.id}">${el.year}<option/>`)
                    });
                }
            });
        });
    </script>
@endpush
@stack('styles')
@stack('scripts')
