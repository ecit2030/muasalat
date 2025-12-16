<x-pages.layout :title="t_('trip details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("trip") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model?->date }}" :label="t_('date')"/>
                                <x-component.input col_size="6" value="{{ $model?->track?->name }}"
                                                   :label="t_('track')"/>
                            </div>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model?->track['origin']['start_time'] }}"
                                                   :label="t_('start time')"/>
                                <x-component.input col_size="6" value="{{ $endAt }}" :label="t_('end time')"/>
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("driver") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model?->track?->driver?->name }}"
                                                   :label="t_('Name')"/>
                                @if(!is_null($model?->track?->owner))
                                <x-component.input col_size="6" value="{{ $model?->track?->owner?->name }}"
                                                   :label="t_('org')"/>
                                @endif
                                <x-component.input col_size="6" value="{{ $model?->track?->driver?->rate }}"
                                                   :label="t_('rate')"/>
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("vehicle") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6"
                                                   value="{{ $model?->track?->vehicle?->year?->model?->name. ' ( '.$model?->track?->vehicle?->year?->model?->brand?->name.' )' }}"
                                                   :label="t_('Name')"/>
                                <x-component.input col_size="6" value="{{ $model?->track?->vehicle?->year?->year }}"
                                                   :label="t_('Model')"/>
                                <x-component.input col_size="6"
                                                   value="{{ $model?->track?->vehicle?->driver?->name ?? $model?->track?->vehicle?->user?->name }}"
                                                   :label="t_('owner')"/>
                                @if(!is_null($model?->track?->vehicle?->driver))
                                <x-component.input col_size="6" value="{{__('driver')}}" :label="t_('type')"/>
                                @else
                                <x-component.input col_size="6" value="{{__('organization')}}" :label="t_('type')"/>
                                @endif
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("all invoices") }}</span>
                            </label>
                            @include('components.datatable.includes.columns.trackReport',['track' =>
                            $model?->track_id , 'date' => $model?->date , 'time' => $model?->origin['start_time'] ])
                            @include('components.datatable.includes.columns.export',["route" => "dashboard.trips.trips.exporttracktrips", "parameter" => ["track" => $model?->track_id , "date" => $model?->date , "time" => $model?->origin["start_time"]] ])
                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("clients") }}</span>
                            </label>
                            @foreach ($trips as $trip)
                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("rate") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $trip->rate }}" :label="t_('rate')"/>
                                <x-component.input col_size="6"
                                                   value="{{ $trip->report?->created_at->format('Y-m-d H:i') }}"
                                                   :label="t_('date')"/>
                                <x-component.input col_size="6" value="{{ $trip->report?->km_price }}"
                                                   :label="t_('kilometer price')"/>
                                <x-component.input col_size="6" value="{{ $trip->report?->total }}"
                                                   :label="t_('grand total')"/>
                            </div>
                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("from").' : '.t_("to") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $trip->origin['location'] }}"
                                                   :label="t_('start point')"/>
                                <x-component.input col_size="6" value="{{ $trip->destination['location'] }}"
                                                   :label="t_('end point')"/>
                            </div>
                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("client") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $trip?->client?->name }}"
                                                   :label="t_('name')"/>
                                <x-component.input col_size="6" value="{{ $trip?->client?->email }}"
                                                   :label="t_('email')"/>
                                <x-component.input col_size="6" value="{{ $trip?->client?->phone }}"
                                                   :label="t_('phone')"/>
                            </div>
                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("e-invoice") }}</span>
                            </label>
                            @if(!is_null($trip?->report?->receipt))
                            @include('components.datatable.includes.columns.report',['report' =>
                            $trip?->report?->receipt ])
                            @endif
                            @include('components.datatable.includes.columns.export',['route' =>
                            "dashboard.trips.trips.exporttrip" , 'parameter' => ["trip" => $trip] ])
                            @if(!$loop->last)
                            <hr>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
