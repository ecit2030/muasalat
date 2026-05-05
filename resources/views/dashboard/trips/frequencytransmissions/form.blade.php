<x-form route="dashboard.trips.frequencytransmissions" :title="t_('frequencytransmissions')">

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

@php
    $data = $data ?? [];
    $origin = $data['origin'] ?? [];
    $destination = $data['destination'] ?? [];
@endphp

    {{-- Name --}}
    <x-form.input 
        name="name" 
        type="text" 
        value="{{ $data['name'] ?? null }}"
        :label="t_('name')" 
    />

     
        {{-- Origin --}}
        <div class="form-group mt-3 row">
            <label>{{ t_('origin_point') }}</label>
            <div class="row">
                <input type="text" name="origin[lat]" id="origin_lat" value="{{ $origin['lat'] ?? '' }}" placeholder="خط العرض"  class="col-md-4" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
                <input type="text" name="origin[lng]" id="origin_lng" value="{{ $origin['lng'] ?? '' }}" placeholder="خط  الطول"  class="col-md-4" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
                <input type="text" name="origin[location]" class="col-md-4" placeholder="اسم الموقع" value="{{ $origin['location'] ?? null }}" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
            </div>
        </div>

        {{-- Destination --}}
        <div class="form-group mt-3 row">
            <label>{{ t_('destination_point') }}</label>
            <div class="row">
                <input type="text" name="destination[lat]" id="destination_lat" placeholder="خط العرض" value="{{ $destination['lat'] ?? '' }}"  class="col-md-4" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
                <input type="text" name="destination[lng]" id="destination_lng" placeholder="خط  الطول" value="{{ $destination['lng'] ?? '' }}"  class="col-md-4" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
                <input type="text" name="destination[location]"  class="col-md-4" placeholder="اسم الموقع" value="{{ $destination['location'] ?? null }}" style="color: var(--kt-input-color);background-color: var(--kt-input-bg);border: 1px solid var(--kt-input-border-color);box-shadow: none !important;border-radius: 0.475rem;padding: 0.775rem 1rem;font-size: 1.1rem;font-weight: 500;">
            </div>
        </div> 
     
    <div class="row">
        {{-- Date --}}
        <div class="form-group mt-3 col-6">
            <div class="col-sm-12 my-6">
                <div class="form-group row no-gutters">
                    <label class="d-flex align-items-center fs-5 fw-semibold  ">
                        <span class=" form-label">{{ t_('date') }}</span></label>
                    @php
                        $date_trans = $data['date_trans'] ?? null;
                    @endphp
                    <div class="col-sm-12 mb-1   ">
                        <div class="d-flex justify-content-center gap-3 align-items-center">
                            <input type="datetime-local"
                                   name="date_trans"
                                   class="form-control"
                                   value="{{ $date_trans ? \Carbon\Carbon::parse($date_trans)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>
                </div>   
            </div>             
        </div>
        <div class="form-group mt-3 col-6">
        {{-- relay_point --}}
        <x-form.input 
            name="relay_point" 
            type="text" 
            value="{{ $data['relay_point'] ?? null }}"
            :label="t_('relay_point')" 
        />
        </div>
    </div>
    <div class="row">
        <div class="form-group mt-3 col-6">
            {{-- map_route_data --}}
            <div class="form-group mt-3">
                <label>{{ t_('map_route_data') }}</label>
                <input type="text" name="map_route_data" class="form-control"
                       value="{{ $data['map_route_data'] ?? '' }}">
            </div>
        </div>
        <div class="form-group mt-3 col-6">
            {{-- specificlocation --}}
            <div class="form-group mt-3">
                <label>{{ t_('specificlocation') }}</label>
                <input type="text" name="specificlocation" class="form-control"
                       value="{{ $data['specificlocation'] ?? null }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group mt-3 col-6">
            {{-- Driver --}}
            <x-form.select 
                name="driver_id" 
                :options="$drivers" 
                :selected="$selectedDriver"
                :label="t_('driver')" 
            />
        </div>
        <div class="form-group mt-3 col-6">
            {{-- Vehicle --}}
            <x-form.select 
                name="vehicle_id" 
                :options="$userVehicles" 
                :selected="$selectedUserVehicle"
                :label="t_('vehicle')" 
            />
        </div>
    </div>
    <div class="row">
        <div class="form-group mt-3">
            <div class="form-group mt-3">
                <label>{{ t_('details') }}</label>
                <textarea id="details" name="details" rows="4" cols="50" class="form-control" value="{{ $data['details'] ?? null }}"></textarea>
            </div>
        </div>
    </div>
    

    {{-- Repeat (days) --}}
    <div class="p-2 pb-3" style="display: none;">
        <label>{{ t_('repeat') }}</label>
        <div class="col-12">

                @php
                    $repeat = $data['repeat'] ?? [];
                @endphp
            @foreach ($days as $key => $day)

                <input type="checkbox"
                       class="btn-check"
                       name="repeat[]"
                       value="{{ $day }}"
                       id="day-{{ $key }}"
                       @checked(in_array($day, $repeat)) />

                <label class="btn btn-secondary"
                       for="day-{{ $key }}">
                    {{ t_($day) }}
                </label>
            @endforeach

        </div>
    </div> 


</x-form>
