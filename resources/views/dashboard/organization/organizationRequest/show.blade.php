<x-pages.layout :title="t_('organization details')">
    <!-- row -->
    <div class="row row-sm">

        @foreach ($errors->all() as $error)
            <div class="text-danger fs-3"> {{ $error }} *</div>
        @endforeach

        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">

                <div>
                    <div class="btn btn-success"
                        onclick="window.location='{{ route('dashboard.organization.organizationRequest.approve', ['id' => $user->id]) }}'">
                        {{ t_('approve') }}</div>

                    <button type="button" class="btn btn-danger"
                    id="rejectModalBtn"
                        {{-- onclick="window.location='{{ route('dashboard.organization.organizationRequest.revoke', ['id' => $user->id]) }}'" --}}
                        >
                        {{ t_('revoke') }}</button>
                </div>
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{ t_('information about') }}</h1>
                            <div class="billed-from">


                                <div class="row">
                                    <div class="col">
                                        <label for="">{{ t_('avatar') }}</label>
                                        <img src="{{ $user?->getFirstMediaUrl('avatar') }}" width="250"
                                            alt="">
                                    </div>

                                    <div class="col">
                                        <label for="">{{ t_('logo') }}</label>
                                        <img src="{{ $user?->getFirstMediaUrl('logo') }}" width="250" alt="">
                                    </div>
                                </div>


                                <div class="row">
                                    <x-component.input col_size="4" :value="$user->name" :label="t_('name')" />
                                    <x-component.input col_size="4" :value="$user->Phone" :label="t_('Phone')" />
                                    <x-component.input col_size="4" :value="$user->email" :label="t_('email')" />
                                </div>


                                <div class="row">
                                    <x-component.input col_size="6" :value="$user->organization_name" :label="t_('organization name')" />
                                    <x-component.input col_size="6" :value="$user->organization_commercial_number" :label="t_('organization commercial number')" />
                                </div>

                                <div class="row">
                                    <x-component.input col_size="4" :value="$user->bank_name" :label="t_('bank name')" />
                                    <x-component.input col_size="4" :value="$user->bank_personal_id" :label="t_('bank personal id')" />
                                    <x-component.input col_size="4" :value="$user->iban" :label="t_('iban')" />
                                </div>



                                <div class="row my-6 ">

                                    <div class="form-group col-md-8">
                                        <div id="map" style="width: 100%; height: 300px;"></div>
                                    </div>
                                    <div class="form-group col-md-4">

                                        <x-component.input :value="$user->address" :label="t_('address')" id="map-address" />
                                        <x-component.input :value="$user->latitude" readonly :label="t_('latitude')"
                                            id="map-lat" />
                                        <x-component.input :value="$user->longitude" readonly :label="t_('longitude')"
                                            id="map-lon" />
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

    <!-- Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">@lang('Reject Reason')</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="message-text" class="col-form-label">@lang('Reject Reason')</label>
            <textarea class="form-control" id="message-text"></textarea>
            <span class="text-danger" id="reject-error"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
          <button id="rejectBtnSave" type="button" class="btn btn-primary">@lang('Save')</button>
        </div>
      </div>
    </div>
  </div>

</x-pages.layout>


@push('scripts')
    <script type="text/javascript"
        src='https://maps.google.com/maps/api/js?key={{ config('custom.GOOGLE_MAP_API', data_get(setting('api_keys'), 'google_api')) }}&sensor=false&libraries=places&language={{ get_current_lang() }}'>
    </script>

    <script src="{{ asset('dashboard/plugins/pickers/location/locationpicker.jquery.js') }}"></script>

    <script>
        $('#rejectModalBtn').on('click', function() {
            $('#rejectModal').modal('show');
        });

        $('#rejectBtnSave').on('click', function() {
            $('#reject-error').text('');
            $('#rejectBtnSave').hide();
            $.ajax({
                url: "{{ route('dashboard.organization.organizationRequest.revoke', ['id' => $user->id]) }}",
                type: "Post",
                data: {
                    'reject_reason': $('#message-text').val(),
                },
                success: function(data) {
                    window.location = "{{ route('dashboard.organization.organizationRequest.index') }}";
                    $('#reject-error').text('');
                    $('#rejectBtnSave').show();
                },
                error: function(data) {
                    $('#reject-error').text(data.responseJSON.message);
                    $('#rejectBtnSave').show();
                }
            });
        })

        $('#map').locationpicker({
            location: {
                latitude: "{{ $user->latitude }}",
                longitude: "{{ $user->longitude }}"
            },
            zoom: 15,
            inputBinding: {
                latitudeInput: $('#map-lat'),
                longitudeInput: $('#map-lon'),
            },

            enableAutocomplete: true,

        });
    </script>
