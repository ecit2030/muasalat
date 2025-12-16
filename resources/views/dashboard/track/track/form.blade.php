<x-form route="dashboard.track.track" :title="t_('track')">

    @foreach ($errors->all() as $error)
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')"/>

    <x-form.input name="name" type="text" value="{{ isset($data['name']) ? $data['name'] : null }}"
                  :label="t_('name')"/>


    <div class="p-2 pb-5 row align-items-center justify-content-center">

        <label for="start_start">{{ t_('repeat') }}</label>
        <div class="col-8 ">
            @foreach ($days as $key => $day)
            <input type="checkbox" class="btn-check" onclick="changeColor(this)" name="repeat[]"
                   value="{{ $day }}" id="btn-check-{{ $key + 1 }}" @checked(in_array($day, isset($data['repeat']) ?
            $data['repeat'] : [])) />

            <label
                class="btn {{ in_array($day, isset($data['repeat']) ? $data['repeat'] : []) ? 'btn-primary' : 'btn-secondary' }} "
                for="btn-check-{{ $key + 1 }}"> {{ t_($day) }} </label>
            @endforeach

        </div>

        <div class="col-4">
            <x-form.input required label_class="p-4" name="start_time" type="time"
                          value="{{ isset($data['origin']['start_time']) ? $data['origin']['start_time'] : null }}"
                          :label="t_('start time')"/>

        </div>

        <div class="row">
            <x-form.select name="driver_id" :options="$drivers" :selected="$selectedDriver" id="driver_id"
                           :label="t_('driver')"/>
            <x-form.select name="user_vehicle_id" :options="$userVehicles" :selected="$selectedUserVehicle"
                           id="user_vehicle_id"
                           :label="t_('vehicle')"/>
        </div>


        <div>
            <div hidden id="address-map"></div>
            <div id="map"></div>
            <div id="sidebar">
                <p>{{ t_('total distance') }} : <span id="total"></span></p>
                <p>{{ t_('total duration') }} : <span id="tot"></span></p>
                <x-form.input id="total-distance" name="total_distance" hidden
                              value="{{ isset($data['distance']) ? $data['distance'] : null }}"/>
                <x-form.input id="total-duration" name="total_duration" hidden
                              value="{{ isset($data['duration']) ? $data['duration'] : null }}"/>
            </div>
        </div>


        <div class="p-4 fs-3 text-danger">
            {{ t_('should_type_all_address') }}
        </div>


        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="start_start">{{ t_('start point') }}</label>
                    <input type="text" id="start-input" name="start_location"
                           value="{{ isset($data['origin']['location']) ? $data['origin']['location'] : 'manosura' }}"
                           class="form-control map-input">
                    <input type="hidden" name="start_latitude" id="start-latitude"
                           value="{{ isset($data['origin']['lat']) ? $data['origin']['lat'] : old('start_latitude') ?? '31.0409' }}"/>
                    <input type="hidden" name="start_longitude" id="start-longitude"
                           value="{{ isset($data['origin']['lng']) ? $data['origin']['lng'] : old('start_longitude') ?? '31.3785' }}"/>
                </div>

                <div class="form-group">
                    <label for="end_end">{{ t_('end point') }}</label>
                    <input type="text" id="end-input" name="end_location"
                           value="{{ isset($data['destination']['location']) ? $data['destination']['location'] : 'cairo' }}"
                           class="form-control map-input">
                    <input type="hidden" name="end_latitude" id="end-latitude"
                           value="{{ isset($data['destination']['lat']) ? $data['destination']['lat'] : old('end_latitude') ?? '31.0409' }}"/>
                    <input type="hidden" name="end_longitude" id="end-longitude"
                           value="{{ isset($data['destination']['lng']) ? $data['destination']['lng'] : old('end_latitude') ?? '31.0409' }}"/>

                    <input type="hidden" name="end_distance" class="distance" id="end-distance" value=""/>
                    <input type="hidden" name="end_duration" class="duration" id="end-duration" value=""/>
                </div>
            </div>

            <div class="levelP col-6 pb-2">
                @if (isset($waypoints))
                @foreach ($waypoints as $key => $waypoint)
                <div class="form-group">
                    <label for="end_end ">{{ t_('check point'). ' '.$key + 1 }} </label>
                    <div class="d-flex " style="column-gap:1rem">
                        <input type="text" id="checkPoint-input-{{ $key + 1 }}"
                               name="checkPoint_location[{{ $key + 1 }}]" class="form-control levelS check-input"
                               value="{{ isset($waypoint['location']) ? $waypoint['location'] : old('checkPoint_location[$key + 1]') ?? null }}">
                        <div class="btn btn-danger px-3" onclick="remove(this)"><i
                                class="fa-regular fa-trash-can fs-3" style="margin-right: 10%"></i></div>
                    </div>
                    <input type="hidden" name="checkPoint_latitude[{{ $key + 1 }}]" class="lat"
                           id="checkPoint-latitude-{{ $key + 1 }}"
                           value="{{ isset($waypoint['lat']) ? $waypoint['lat'] : '31.378' }}"/>
                    <input type="hidden" name="checkPoint_longitude[{{ $key + 1 }}]" class="lng"
                           id="checkPoint-longitude-{{ $key + 1 }}"
                           value="{{ isset($waypoint['lng']) ? $waypoint['lng'] : '31.378' }}"/>
                    <input type="hidden" name="checkPoint_distance[{{ $key + 1 }}]" class="distance"
                           id="checkPoint-distance-{{ $key + 1 }}" value=""/>
                    <input type="hidden" name="checkPoint_duration[{{ $key + 1 }}]" class="duration"
                           id="checkPoint-duration-{{ $key + 1 }}" value=""/>
                </div>
                @endforeach

                @endif
            </div>
            <div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label>{{ t_('waypoints') }}</label>
                        </div>
                    </div>
                </div>
                <div class="parentIcon mt-4" onclick="newLevel()">
                    <i class="fa-solid fa-circle-plus"></i>
                </div>

            </div>
        </div>

        <input type="hidden" name="map_route_data" id="map-route-data"
               value="{{ isset($data['map_route_data']) ? $data['map_route_data'] : '' }}"/>
</x-form>


<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=initMap&libraries=places&v=weekly&language=ar-SA&region=ar-SA"
    defer></script>

<script src="{{ asset('dashboard/js/trackMap.js') }}"></script>


<link rel="stylesheet" href="{{ asset('dashboard/css/trackMap.css') }}">

<script>
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
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var timeInput = document.querySelector('input[name="start_time"]');
        timeInput.addEventListener('input', function () {
            var time = timeInput.value.split(':');
            var minutes = parseInt(time[1]);
            var remainder = minutes % 5;
            if (remainder !== 0) {
                minutes = minutes - remainder;
                if (remainder >= 3) {
                    minutes += 5;
                }
                timeInput.value = time[0] + ':' + minutes.toString().padStart(2, '0');
            }
        });
    });
</script>
