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
                                {{--                                <x-component.input col_size="6" value="{{ $model?->track?->name }}"--}}
                                {{--                                                   :label="t_('track')"/>--}}
                            </div>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model?->time }}"
                                                   :label="t_('start time')"/>
                                <x-component.input col_size="6" value="{{ $endAt }}" :label="t_('end time')"/>
                            </div>

                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model?->origin['location'] ?? '--' }}"
                                                   :label="t_('start point')"/>
                                <x-component.input col_size="6" value="{{ $model?->destination['location'] ?? '--' }}"
                                                   :label="t_('end point')"/>
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("driver") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6" value="{{ $model->driver?->name }}"
                                                   :label="t_('Name')"/>
                                {{--                                @if(!is_null($model?->track?->owner))--}}
                                {{--                                <x-component.input col_size="6" value="{{ $model?->track?->owner?->name }}"--}}
                                {{--                                                   :label="t_('org')"/>--}}
                                {{--                                @endif--}}
                                <x-component.input col_size="6" value="{{ $model->driver?->rate }}"
                                                   :label="t_('rate')"/>
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("vehicle") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6"
                                                   value="{{ $model?->driver?->vehicle?->year?->model?->name. ' ( '.$model?->track?->vehicle?->year?->model?->brand?->name.' )' }}"
                                                   :label="t_('Name')"/>
                                <x-component.input col_size="6" value="{{ $model?->driver?->vehicle?->year?->year }}"
                                                   :label="t_('Model')"/>
                                <x-component.input col_size="6"
                                                   value="{{ $model?->driver?->vehicle?->driver?->name ?? $model?->driver?->vehicle?->user?->name }}"
                                                   :label="t_('owner')"/>
                                @if(!$model?->driver?->driverOrg()->exists())
                                    <x-component.input col_size="6" value="{{__('driver')}}" :label="t_('type')"/>
                                @else
                                    <x-component.input col_size="6" value="{{__('organization')}}" :label="t_('type')"/>
                                @endif
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("invoice") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6"
                                                   value="{{ $model?->report?->created_at->format('Y-m-d H:i') }}"
                                                   :label="t_('date')"/>
                                <x-component.input col_size="6" value="{{ $model?->report?->km_price }}"
                                                   :label="t_('kilometer price')"/>
                                <x-component.input col_size="6" value="{{ $model?->report?->total }}"
                                                   :label="t_('grand total')"/>
                            </div>

                            <label class="d-flex align-items-center fs-4 fw-semibold">
                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("client") }}</span>
                            </label>
                            <div class="row">
                                <x-component.input col_size="6"
                                                   value="{{ $model?->client?->full_name ?? $model?->client?->name }}"
                                                   :label="t_('name')"/>
                                <x-component.input col_size="6" value="{{ $model?->client?->email }}"
                                                   :label="t_('email')"/>
                                <x-component.input col_size="6" value="{{ $model?->client?->phone }}"
                                                   :label="t_('phone')"/>
                            </div>
                            @if($model->driver()->exists())

                                <label class="d-flex align-items-center fs-4 fw-semibold">
                                    <span class="form-label fs-4 ps-4 pt-4">{{ t_("e-invoice") }}</span>
                                </label>
                                @if($model?->report)
                                    {{--@php
                                        $path = parse_url($model ?->report ?->receipt, PHP_URL_PATH);
                                        // Remove the 'storage' prefix from the path
                                        $relativePath = str_replace('storage/', '', $path);
                                    @endphp
                                    @if(\Storage::disk('public')->exists($relativePath))
                                    <div class="row">
                                        <iframe src="{{ $model?->report?->receipt }}" width="100%" height="600px"></iframe>
                                    </div>
                                    @endif --}}
                                    @include('components.datatable.includes.columns.report',['report' =>
                                    url('/client/trip/get-details-pdf/' . $model?->report?->id . '/' . get_current_lang()) ])
                                @endif
                                @include('components.datatable.includes.columns.export',['route' => "dashboard.trips.trips.exporttrip" , 'parameter' => ["trip" => $model] ])
                                {{--                            <label class="d-flex align-items-center fs-4 fw-semibold">--}}
                                {{--                                <span class="form-label fs-4 ps-4 pt-4">{{ t_("clients") }}</span>--}}
                                {{--                            </label>--}}
                                {{--                            <x-component.menurapper>--}}
                                {{--                                @foreach ($trips as $trip)--}}
                                {{--                                <x-component.menu :model="$trip"/>--}}
                                {{--                                @endforeach--}}
                                {{--                            </x-component.menurapper>--}}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
