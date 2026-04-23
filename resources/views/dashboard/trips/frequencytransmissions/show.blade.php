<x-pages.layout :title="t_('frequency transmission details')">

<div class="row row-sm">
    <div class="col-md-12 col-xl-12">

        <div class="main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body">

                    {{-- STATUS --}}
                    <div class="d-flex justify-center gap-3 pt-3" style="font-size:25px">
                        @if ($model->is_active)
                            <x-ui.badge :class="'fs-2'" :value="t_('active')" color="success" />
                        @else
                            <x-ui.badge :class="'fs-2'" :value="t_('inactive')" color="secondary" />
                        @endif
                    </div>
                        <div class="row mt-3">
                            {{-- NAME --}}
                            <x-component.input  :col_size="6"
                                name="name"
                                type="text"
                                :value="$model->name"
                                :label="t_('name')" />
     
                            <x-component.input  :col_size="6"
                                name="date_trans"
                                type="text"
                                :value="$model->date_trans"
                                :label="t_('date')" />
                        </div>

                    {{-- LOCATIONS --}}

                    <div class="row mt-3">
                        <x-component.input  :col_size="4"
                            name="origin_point"
                            type="text"
                            :value="$model->origin['location']"
                            :label="t_('origin_point')" />
                     
                        <x-component.input  :col_size="4"
                            name="destination_point"
                            type="text"
                            :value="$model->destination['location']"
                            :label="t_('destination_point')" />
                     
                        <x-component.input  :col_size="4"
                            name="relay_point"
                            type="text"
                            :value="$model->relay_point"
                            :label="t_('relay_point')" />
                    </div> 

                    {{-- DRIVER / VEHICLE --}}
                    <div class="row mt-3">
                        <x-component.input :col_size="6" :value="$driver" :label="t_('driver')" />
                        <x-component.input :col_size="6" :value="$vehicle" :label="t_('vehicle')" />
                    </div>
                    
                    <div class="mt-3">
                        <x-component.input
                            name="specificlocation"
                            type="text"
                            :value="$model->specificlocation"
                            :label="t_('specificlocation')" />
                    </div> 

                    {{-- REPEAT DAYS --}}
                    <div class="p-2 pb-4">
                        <label>{{ t_('repeat') }}</label>

                        <div class="col-12">
                            @foreach ($days as $key => $day)

                                @php
                                    $repeat = $model->repeat ?? [];
                                @endphp

                                <input type="checkbox"
                                       class="btn-check"
                                       disabled
                                       value="{{ $day }}"
                                       id="day-{{ $key }}"
                                       @checked(in_array($day, $repeat)) />

                                <label class="btn {{ in_array($day, $repeat) ? 'btn-primary' : 'btn-secondary' }}"
                                       for="day-{{ $key }}">
                                    {{ t_($day) }}
                                </label>

                            @endforeach
                        </div>
                    </div>  

                </div>
            </div>

        </div>
    </div>
</div>

</x-pages.layout>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap&libraries=places&v=weekly"
    defer></script>

<script src="{{ asset('dashboard/js/trackMap.js') }}"></script>
<link rel="stylesheet" href="{{ asset('dashboard/css/trackMap.css') }}">