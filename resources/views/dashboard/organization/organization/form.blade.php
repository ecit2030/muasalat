<x-form route="dashboard.organization.organization" :title="t_('organization')">

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    {{-- <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')" /> --}}
    <x-form.image name="avatar" :value="$avatar" :label="t_('Avatar')" />

    <div class="row">
        <x-form.input col_size="4" name="name" :label="t_('Name')" />
        <x-form.input col_size="4" name="phone" :value="$phone" type="number" :label="t_('Phone')" />
        <x-form.input col_size="4" name="email" type="email" :label="t_('Email')" />
    </div>

    <div class="row">
        <x-form.input col_size="6" name="organization_name"  :label="t_('organization name')" />
        <x-form.input col_size="6" name="organization_commercial_number" type="number" :label="t_('organization commercial number')" />
    </div>


    <div class="row">
        <x-form.input col_size="4" name="bank_name" :label="t_('bank name')" />
        <x-form.input col_size="4" name="bank_personal_id" type="number" :label="t_('bank personal id')" />
        <x-form.input col_size="4" name="iban" type="text" :label="t_('iban')" />
    </div>

    <div class="row">
        <x-form.password col_size="6" name="password" type="password" :label="t_('Password')"/>
    </div>

    <div class="row ">
        <div class="col-md-3">
            <x-form.image name="logo" :value="$logo" :label="t_('logo')" />
        </div>

        <div class="col-md-9">

            <label for="start">{{ t_('address') }}</label>
            <input type="text" id="start-input" name="address" value="{{ old('address') ?? $model?->address }}"
                value="{{ 'manosura' }}" class="form-control map-input my-2">


            <input type="hidden" name="latitude" id="start-latitude" value="{{ $model?->latitude ?? '31.0409' }}" />
            <input type="hidden" name="longitude" id="start-longitude" value="{{ $model?->longitude ?? '31.3785' }}" />


            <div hidden id="address-map"></div>
            <div id="map"></div>
        </div>
    </div>


</x-form>


<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=initMap&libraries=places&v=weekly&language=ar-SA&region=ar-SA"
    defer></script>


<script>
    function initMap() {
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        looping()
    }

    function looping() {
        const lat = Number(document.getElementById("start-latitude").value);
        const lng = Number(document.getElementById("start-longitude").value);

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: {
                lat: lat,
                lng: lng
            },
            position: {
                lat: lat,
                lng: lng
            },
            draggable: true
        });

        const marker = new google.maps.Marker({
            map,
            position: {
                lat: lat,
                lng: lng
            },
            draggable: true
        });

        locationInputs = document.getElementsByClassName("map-input")
        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;

        for (let i = 0; i < locationInputs.length; i++) {
            const input = locationInputs[i];
            const fieldKey = input.id.replace("-input", "");
            const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
                fieldKey + "-longitude").value != '';
            const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
            const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;
            const map = new google.maps.Map(document.getElementById('address-map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 13,
                draggable: true
            });

            const marker = new google.maps.Marker({
                map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
            });

            marker.setVisible(isEdit);
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({
                input: input,
                map: map,
                marker: marker,
                autocomplete: autocomplete
            });
        }

        google.maps.event.addListener(marker, 'dragend', function() {
            latlng = {
                location: {
                    lat: marker.position.lat(),
                    lng: marker.position.lng(),
                }
            }
            getNameByGeoCode(latlng, "start-input")
        });

        for (let i = 0; i < autocompletes.length; i++) {
            const input = autocompletes[i].input;
            const autocomplete = autocompletes[i].autocomplete;
            const map = autocompletes[i].map;
            const marker = autocompletes[i].marker;
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                geocoder.geocode({
                    'placeId': place.place_id
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng);
                    }
                });
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });
        }
    }

    function setLocationCoordinates(key, lat, lng) {
        const latitudeField = document.getElementById(key + "-" + "latitude");
        const longitudeField = document.getElementById(key + "-" + "longitude");
        latitudeField.value = lat;
        longitudeField.value = lng;
        looping();
    }

    function getNameByGeoCode(latlng, id) {
        const geocoder = new google.maps.Geocoder();
        geocoder
            .geocode({
                location: latlng.location ? latlng.location : latlng
            })
            .then((response) => {
                if (response.results[0]) {
                    locationName = locationName = response.results[0].formatted_address.split(",").join(" ");
                    document.getElementById(id).value = locationName
                } else {
                    window.alert("No results found");
                }
            })
        // .catch((e) => window.alert("Geocoder failed due to: " + e));
    }
    window.initMap = initMap;
</script>

<style>
    #map,
    #bestmap,
    #to_map {
        height: 300px;
        width: 100%;
    }

    .btn:focus {
        color: #fff;
        background-color: var(--kt-secondary);
    }
</style>
