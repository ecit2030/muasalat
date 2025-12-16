<x-pages.layout :title="t_('track details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">


                            <div class="billed-from">
                                <div class="d-flex justify-center gap-3 pt-5" style="font-size:30px">
                                    @if ($model->is_active)
                                        <x-ui.badge :class="'fs-2'" :value="t_('active')" color="success" />
                                    @else
                                        <x-ui.badge :class="'fs-2'" :value="t_('not active')" color="danger" />
                                    @endif
                                </div>
                            </div>

                            <x-component.input name="name" type="text" value="{{ $data['name'] }}" :label="t_('name')" />


                            <div class="p-2 pb-5 row align-items-center justify-content-center">

                                <label for="start_start">{{ t_('repeat') }}</label>
                                <div class="col-8 ">

                                    @foreach ($days as $key => $day)
                                        <input type="checkbox" class="btn-check" disabled name="repeat[]" value="{{ $day }}"
                                            id="btn-check-{{ $key + 1 }}" @checked(in_array($day, $data['repeat'] )) />
                                        <label

                                            class="btn {{ in_array($day, $data['repeat'] ) ? 'btn-primary' : 'btn-secondary' }} " for="btn-check-{{ $key + 1 }}"> {{ t_($day) }} </label>
                                    @endforeach

                                </div>

                                <div class="col-4">
                                    <x-component.input label_class="p-4" name="start_time" type="time" value="{{  $data['origin']['start_time'] }}" :label="t_('start time')" />
                                </div>

                                <div class="row">
                                    <x-component.input :col_size="6"  :value="$driver"  :label="t_('driver')" />
                                    <x-component.input :col_size="6"  :value="$vehicle"  :label="t_('vehicle')" />
                                </div>


                                <div>
                                    <div hidden id="address-map"></div>
                                    <div id="map"></div>
                                    <div id="sidebar">
                                        <p>{{ t_("total distance")}} : <span id="total"></span></p>
                                        <p>{{ t_("total duration")}} : <span id="tot"></span></p>
                                        <x-form.input id="total-distance" name="total_distance" hidden value="{{ $data['distance'] }}" />
                                        <x-form.input id="total-duration" name="total_duration" hidden value="{{ $data['duration']}}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="start_start">{{ t_('start point') }}</label>
                                            <input type="text" id="start-input" name="start_location" disabled value="{{  $data['origin']['location'] }}" class="form-control map-input">
                                            <input type="hidden" name="start_latitude" id="start-latitude" value="{{ $data['origin']['lat'] }}" />
                                            <input type="hidden" name="start_longitude" id="start-longitude" value="{{ $data['origin']['lng'] }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="end_end">{{ t_('end point') }}</label>
                                            <input type="text" id="end-input" name="end_location" disabled value="{{ $data['destination']['location'] }}" class="form-control map-input">
                                            <input type="hidden" name="end_latitude" id="end-latitude" value="{{$data['destination']['lat'] }}" />
                                            <input type="hidden" name="end_longitude" id="end-longitude" value="{{ $data['destination']['lng'] }}" />

                                            <input type="hidden" name="end_distance" class="distance" id="end-distance" value="" />
                                            <input type="hidden" name="end_duration" class="duration" id="end-duration" value="" />
                                        </div>
                                    </div>

                                    <div class="levelP col-6 pb-2">
                                        @if (isset($waypoints))
                                            @foreach ($waypoints as $key => $waypoint)
                                                <div class="form-group">
                                                    <label for="end_end ">{{ t_('check point') . ' ' . $key + 1 }}
                                                    </label>
                                                    <div class="d-flex " style="column-gap:1rem">
                                                        <input type="text" id="checkPoint-input-{{ $key + 1 }}" disabled name="checkPoint_location[{{ $key + 1 }}]"class="form-control levelS check-input" value="{{ $waypoint['location'] }}">
                                                    </div>
                                                    <input type="hidden" name="checkPoint_latitude[{{ $key + 1 }}]" class="lat" id="checkPoint-latitude-{{ $key + 1 }}" value="{{ $waypoint['lat'] }}" />
                                                    <input type="hidden" name="checkPoint_longitude[{{ $key + 1 }}]" class="lat" id="checkPoint-longitude-{{ $key + 1 }}" value="{{ $waypoint['lng'] }}" />
                                                    <input type="hidden" name="checkPoint_distance[{{ $key + 1 }}]" class="distance" id="checkPoint-distance-{{ $key + 1 }}" value="" />
                                                    <input type="hidden" name="checkPoint_duration[{{ $key + 1 }}]" class="duration" id="checkPoint-duration-{{ $key + 1 }}" value="" />
                                                </div>
                                            @endforeach

                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- COL-END -->
            </div>
            <!-- Message Modal -->

</x-pages.layout>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=initMap&libraries=places&v=weekly&language=ar-SA&region=ar-SA"
    defer></script>

<script src="{{ asset('dashboard/js/trackMap.js')}}"></script>

<link rel="stylesheet" href="{{ asset('dashboard/css/trackMap.css')}}">
