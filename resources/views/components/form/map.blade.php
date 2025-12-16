@aware(['address' => 'address', 'radius' => 'radius', 'latitude' => 'latitude', 'longitude' => 'longitude'])


<div class="row my-6 ">
    <div class="form-group col-md-8">
        <div id="map" style="width: 100%; height: 300px;"></div>
    </div>


    <div class="form-group col-md-4">
        <x-form.input :name="$address" hidden id="address" />
        <x-form.input :name="$address" :label="t_($address)" id="map-address" />
        <x-form.input :name="$radius" :label="t_($radius)" id="map-radius" />
        <x-form.input :name="$latitude" readonly :label="t_($latitude)" id="map-lat" />
        <x-form.input :name="$longitude" readonly :label="t_($longitude)" id="map-lon" />
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
        src='https://maps.google.com/maps/api/js?key={{ config('custom.GOOGLE_MAP_API', data_get(setting('api_keys'), 'google_api')) }}&sensor=false&libraries=places&language={{ get_current_lang() }}'>
    </script>

    <script src="{{ asset('dashboard/plugins/pickers/location/locationpicker.jquery.js') }}"></script>

    <script>
        $('#map').locationpicker({
            location: {
                latitude: "{{ $model->latitude ?? ($latitude ?? 25.004958215084052) }}",
                longitude: "{{ $model->longitude ?? ($longitude ?? 44.55966186523437) }}"
            },
            zoom: 10,
            radius: "{{ $model->radius ?? 4000 }}",
            inputBinding: {
                latitudeInput: $('#map-lat'),
                longitudeInput: $('#map-lon'),
                radiusInput: $('#map-radius'),
                locationNameInput: $('#map-address')
            },
            enableAutocomplete: true,
            onchanged: function(currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
    </script>
@endpush
