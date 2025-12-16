<x-form route="dashboard.driver.driver" :title="t_('drivers')">

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    {{-- <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')" /> --}}
    <x-form.image name="avatar" :value="$avatar" :label="t_('Avatar')" />

    <div class="row">
        <x-form.input col_size="6" name="name" :label="t_('Name')" />
        <x-form.input col_size="6" name="phone" :value="$phone" type="number" :label="t_('Phone')" />
    </div>

    <div class="row">
        <x-form.input col_size="6" name="email" type="email" :label="t_('Email')" />
        <x-form.input col_size="6" name="date_of_birth" type="date" :label="t_('date of birth')" />
    </div>

    <div class="row">
        <x-form.password col_size="6" name="password" type="password" :label="t_('Password')"/>
    </div>


    <div class="row">
        <x-form.input col_size="4" name="ussid_number" :value="$ussidNumber" :label="t_('ussid number')" />
        <x-form.input col_size="4" name="driver_license_number" type="number" :value="$driverLicenseNumber" :label="t_('driver license number')" />
        <x-form.input col_size="4" name="driver_license_end_date" type="date" :value="$driverLicenseEndDate" :label="t_('driver license end date')" />
    </div>

    <div class="row">
        <x-form.image col_size="6" name="ussid" :value="$ussid" :label="t_('ussid')" />
        <x-form.image col_size="6" name="driver_license" :value="$driverLicense" :label="t_('driver license')" />
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
                url: `{{ route('dashboard.driver-vehicle-model.ajax.get') }}`,
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
            $("#shadow").toggleClass("d-none");
            $.ajax({
                url: `{{ route('dashboard.driver-vehicle-year.ajax.get') }}`,
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
