@extends('Site.layouts.app')
@section('title')
    {{ t_('organization regiser form') }}
@endsection

@push('styles')
    <style>
        main {
            border: 1px solid #a7a7a7;
        }
    </style>
@endpush

@section('content')
    <div class="policy">
        <div class="container">


            <form id="form" class="side_image" action="{{ route('frontend.postOrg') }}" method="post"
                enctype="multipart/form-data">

                @csrf

                <div class="row">
                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="name" class="form-label">{{ t_('name') }}</label>
                        <input required type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="phone"  class="form-label">{{ t_('phone') }}</label>
                        <input placeholder="0512345678" required pattern="^(05)\d{8}$" type="text`" class="form-control" name="phone" value="{{ old('phone') }}"id="phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="email" class="form-label">{{ t_('Email') }}</label>
                        <input required type="email" class="form-control" name="email" value="{{ old('email') }}"
                            id="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <div class="row">
                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="organization_name" class="form-label">{{ t_('organization name') }}</label>
                        <input required type="organization_name" class="form-control" name="organization_name"
                            value="{{ old('organization_name') }}" id="organization_name">
                        @error('organization_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="organization_commercial_number"
                            class="form-label">{{ t_('organization commercial number') }}</label>
                        <input required type="number" class="form-control" name="organization_commercial_number"
                            value="{{ old('organization_commercial_number') }}" id="organization_commercial_number">
                        @error('organization_commercial_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="bank_name" class="form-label">{{ t_('bank name') }}</label>
                        <input required type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}"
                            id="bank_name">
                        @error('bank_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="bank_personal_id" class="form-label">{{ t_('bank personal id') }}</label>
                        <input required type="number" class="form-control" name="bank_personal_id"
                            value="{{ old('bank_personal_id') }}" id="bank_personal_id">
                        @error('bank_personal_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6 col-xs-12">
                        <label for="iban" class="form-label">{{ t_('iban') }}</label>
                        <input required type="text" class="form-control" name="iban" value="{{ old('iban') }}"
                            id="iban">
                        @error('iban')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="mb-3">
                            <label for="logo" class="form-label">{{ t_('logo') }}</label>
                            <input class="form-control" type="file" name="logo" value="{{ old('logo') }}"
                                id="logo">
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="mb-3">
                            <label for="avatar" class="form-label">{{ t_('avatar') }}</label>
                            <input class="form-control" type="file" name="avatar" value="{{ old('avatar') }}"
                                id="avatar">
                            @error('avatar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label for="start">{{ t_('address') }}</label>
                    <input type="text" id="start-input" name="address" value="{{ old('address') }}"
                        value="{{ 'manosura' }}" class="form-control map-input my-2">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="latitude" id="start-latitude" value="{{ old('latitude') ?? '31.0409' }}" />
                    <input type="hidden" name="longitude" id="start-longitude" value="{{ old('longitude') ?? '31.3785' }}" />


                    <div hidden id="address-map"></div>
                    <div id="map"></div>
                </div>

                <button type="submit" class="btn btn-primary my-2">{{ t_('Submit') }}</button>
            </form>

        </div>
    </div>
@endsection


<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap&libraries=places&v=weekly&language=ar-SA&region=ar-SA"
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

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .side_image {
        /* background-image: url('http://127.0.0.1:8000/site/images/logo.png'); */
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        padding: 20px;
        box-shadow: 10px 15px #a7a7a7;
        border: 1px solid #a7a7a7;
        border-radius: 15px;
    }
</style>
