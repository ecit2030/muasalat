function initMap() {

    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    startMapping()
    looping()
    loopingForWaypoints()
}

function startMapping() {

    const start_lat = Number(document.getElementById("start-latitude").value);
    const start_lng = Number(document.getElementById("start-longitude").value);
    const end_lat = Number(document.getElementById("end-latitude").value);
    const end_lng = Number(document.getElementById("end-longitude").value);

    wayPoints = [];
    wayPointElements = document.getElementsByClassName("check-input")

    wayPointElements.forEach((el, i) => {
        index = wayPointElements[i].id.replace(`checkPoint-input-`, "");

        lat = Number($(`#checkPoint-latitude-${index}`).val());
        lng = Number($(`#checkPoint-longitude-${index}`).val());
        wayPoint = {
            location: {
                lat: lat,
                lng: lng
            }
        }
        wayPoints.push(wayPoint)
    })
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: {
            lat: end_lat - start_lat == 0 ? 37.77 : (end_lat - start_lat) / 2,
            lng: end_lng - start_lng == 0 ? -122.447 : (end_lng - start_lng) / 2
        },
    });
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map,
        gestureHandling: "greedy",
        draggable: true,

    });

    directionsRenderer.addListener("directions_changed", () => {
        const directions = directionsRenderer.getDirections();

        if (directions) {
            locations = directions.geocoded_waypoints;
            var isAllDifferent = true;
            if (locations.length > 1) {
                isAllDifferent = hasIdenticalElements(locations)
                if(isAllDifferent){
                    originRendered = directionsRenderer.directions.request.origin;
                    originRendered = originRendered.location ? originRendered.location : originRendered;

                    destinationRendered = directionsRenderer.directions.request.destination;
                    destinationRendered = destinationRendered.location ? destinationRendered.location :
                        destinationRendered;

                    waypointsRendered = directionsRenderer.directions.request.waypoints;
                    waypoints = [];

                    waypointsRendered.forEach((el, i) => {
                        waypoint = el.location.location ? el.location.location : el.location;
                        waypoint = {
                            location: {
                                lat: waypoint.lat(),
                                lng: waypoint.lng(),
                            }
                        }
                        index = locationInputs[i].id.replace(`checkPoint-input-`, "");

                        $(`#checkPoint-latitude-${index}`).val(waypoint.location.lat);
                        $(`#checkPoint-longitude-${index}`).val(waypoint.location.lng);

                        getNameByGeoCode(waypoint, `checkPoint-input-${index}`);
                        waypoints.push(waypoint)
                    });

                    origin = {
                        lat: originRendered.lat(),
                        lng: originRendered.lng(),
                    }

                    $("#start-latitude").val(origin.lat);
                    $("#start-longitude").val(origin.lng);

                    destination = {
                        lat: destinationRendered.lat(),
                        lng: destinationRendered.lng(),
                    }
                    $("#end-latitude").val(destination.lat);
                    $("#end-longitude").val(destination.lng);

                    getNameByGeoCode(origin, "start-input");
                    getNameByGeoCode(destination, "end-input");
                    computeTotalDistance(directions);
                }
                else{
                    var locale = "{{ app()->getLocale() }}";
                    alert(locale === 'ar' ? "لايمكن إضافة نفس النقطة أكثر من مرة" : "Can\'t add same point multiple times");
                }
            }
        }
    });

    origin = {
        lat: start_lat,
        lng: start_lng,
    }

    destination = {
        lat: end_lat,
        lng: end_lng,
    }


    displayRoute(
        origin,
        destination,
        wayPoints,
        directionsService,
        directionsRenderer
    );
}

function loopingForWaypoints() {
    locationInputs = document.getElementsByClassName("check-input")
    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;
    for (let i = 0; i < locationInputs.length; i++) {

        const input = locationInputs[i];
        index = input.id.replace(`checkPoint-input-`, "");
        const fieldKey = input.id.replace(`-input-${index}`, "");
        const isEdit = document.getElementById(`${fieldKey}-latitude-${index}`).value != '' &&
            document.getElementById(`${fieldKey}-longitude-${index}`).value != '';

        const latitude = parseFloat(document.getElementById(`${fieldKey}-latitude-${index}`).value) || -33.8688;
        const longitude = parseFloat(document.getElementById(`${fieldKey}-longitude-${index}`).value) || 151.2195;


        const map = new google.maps.Map(document.getElementById('address-map'), {
            center: {
                lat: latitude,
                lng: longitude
            },
            zoom: 13
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

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            marker.setVisible(false);
            const place = autocomplete.getPlace();
            index = input.id.replace(`checkPoint-input-`, "");

            geocoder.geocode({
                'placeId': place.place_id
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    setLocationCoordinatesForCheck(autocomplete.key, lat, lng, index);
                }
            });

            if (!place.geometry) {
                // window.alert("No details available for input: '" + place.name + "'");
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

function looping() {
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
            zoom: 13
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

function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
    startMapping();

}

function setLocationCoordinatesForCheck(key, lat, lng, i) {
    const latitudeField = document.getElementById(`${key}-latitude-${i}`);
    const longitudeField = document.getElementById(`${key}-longitude-${i}`);
    latitudeField.value = lat;
    longitudeField.value = lng;
    startMapping();

}

function displayRoute(origin, destination, waypoints, service, display) {
    service
        .route({
            origin: origin,
            destination: destination,
            waypoints: waypoints,
            travelMode: google.maps.TravelMode.DRIVING,
            avoidTolls: true,
        })
        .then((result) => {
            display.setDirections(result);
        })
        .catch((e) => {
            // alert("Could not display directions due to: " + e);
        });
}

function computeTotalDistance(result) {
    let distance = 0;
    let duration = 0;
    let totalDistance = 0;
    let totalDuration = 0;
    const myroute = result.routes[0];

    if (!myroute) {
        return;
    }

    mapRouteData = [];
    myroute.legs.forEach(el => {
        el.steps.forEach(el => {
            el.lat_lngs.forEach(el => {
                mapRouteData.push({
                    "lat": el.lat(),
                    "lng": el.lng(),
                })
            })
        })
    });

    mapRouteData = JSON.stringify(mapRouteData);
    $(`#map-route-data`).val(mapRouteData);



    if (waypoints.length > 0) {
        waypoints.forEach(function(el, i) {
            for (let j = 0; j <= i; j++) {
                distance += myroute.legs[j].distance.value;
                duration += myroute.legs[j].duration.value;
            }
            $(`#checkPoint-distance-${i + 1}`).val(distance);
            $(`#checkPoint-duration-${i + 1}`).val(duration);

        })

    }

    for (let i = 0; i < myroute.legs.length; i++) {
        totalDistance += myroute.legs[i].distance.value;
        totalDuration += myroute.legs[i].duration.value;
    }

    $("#end-distance").val(totalDistance);
    $("#end-duration").val(totalDuration);

    $("#total-distance").val(totalDistance);
    $("#total-duration").val(totalDuration);

    totalDistance = totalDistance / 1000;
    totalDuration = new Date(totalDuration * 1000).toISOString().substring(11, 16);
    document.getElementById("total").innerHTML = totalDistance + " km";
    document.getElementById("tot").innerHTML = totalDuration + " Hours";


}

function newLevel() {
    count = $(".levelS").length;
    if (count < 10) {
        id = count + 1;
        $(".levelP").append(`<div class="form-group">
                <label for="end_end">{{ t_('check point') }} ${id} </label>
                <div class="d-flex">
                    <input type="text" id="checkPoint-input-${id}" name="checkPoint_location[${id}]" class="form-control check-input levelS">
                    <div class="btn btn-danger px-3" onclick="remove(this)" ><i class="fa-regular fa-trash-can fs-3" style="margin-right: 10%"></i></div>
                </div>
                <input type="hidden" name="checkPoint_latitude[${id}]"  class="lat" id="checkPoint-latitude-${id}" value="31.0409483" />
                <input type="hidden" name="checkPoint_longitude[${id}]"  class="lng" id="checkPoint-longitude-${id}" value="31.3784704" />
                <input type="hidden" name="checkPoint_distance[${id}]" class="distance" id="checkPoint-distance-${id}" value="" />
                <input type="hidden" name="checkPoint_duration[${id}]" class="duration" id="checkPoint-duration-${id}" value="" />
            </div>`);
    } else {
        $(".parentIcon").css("border-top", "3px solid #f1416c");
        $(".parentIcon i").css("color", "#f1416c");
    }

    loopingForWaypoints()
}

function remove(element) {
    $(element).parent().parent().remove();
    count = $(".levelS").length;
    if (count < 10) {
        $(".parentIcon").css("border-top", "3px solid #009ef7");
        $(".parentIcon i").css("color", "#009ef7");
    }
    reOrder()
    startMapping()
}

function reOrder() {
    wayPointElements = document.getElementsByClassName("check-input")
    wayPointElements.forEach((el, i) => {

        str = $(el).parent().parent().children().closest("label").html();
        $(el).parent().parent().children().closest("label").html(str.replace(/[0-9]/g, `${i + 1 }`));

        el.id = `checkPoint-input-${i +1}`;
        el.name = `checkPoint_location[${i +1}]`;

        $(el).parent().parent().children().closest(".lat").attr("id", `checkPoint-latitude-${i +1}`);
        $(el).parent().parent().children().closest(".lat").attr("name", `checkPoint_latitude[${i +1}]`);

        $(el).parent().parent().children().closest(".lng").attr("id", `checkPoint-longitude-${i +1}`);
        $(el).parent().parent().children().closest(".lng").attr("name", `checkPoint_longitude[${i +1}]`);

        $(el).parent().parent().children().closest(".distance").attr("id", `checkPoint-distance-${i +1}`);
        $(el).parent().parent().children().closest(".distance").attr("name", `checkPoint_distance[${i +1}]`);

        $(el).parent().parent().children().closest(".duration").attr("id", `checkPoint-duration-${i +1}`);
        $(el).parent().parent().children().closest(".duration").attr("name", `checkPoint_duration[${i +1}]`);
    })

}


function changeColor(element) {
    $(element).next().toggleClass("btn-secondary")
    $(element).next().toggleClass("btn-primary")
}

function hasIdenticalElements(arr) {
    const uniqueElements = new Set();
    for (const element of arr) {
        if (uniqueElements.has(element.place_id)) {
            // If the element is already in the set, raise a flag (e.g., return true)
            return false;
        }
        // Add the element to the set
        uniqueElements.add(element.place_id);
    }
    // If no identical elements are found, return false
    return true;
}

window.initMap = initMap;
