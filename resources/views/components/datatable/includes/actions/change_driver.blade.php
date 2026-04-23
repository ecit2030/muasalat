@if($status_driver != 1)
<button class="btn btn-icon  btn-active-color-warning btn-sm me-1"
        data-bs-toggle="modal"
        data-bs-target="#changeDriverModal-{{ $id }}">
    <i class="bi bi-pen"></i>
</button>
@endif
<div class="modal fade" id="changeDriverModal-{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="dashboard.trips.frequencytransmissions.changeDriver', $id">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{ t_('Change Driver') }}</h5>
                </div>

                <div class="modal-body">
                    <select name="driver_id" class="form-control" required>
                        @foreach(\App\Models\User::role('captain')->pluck('name','id') as $id => $name)
                            <option value="{{ $id }}" @selected($id == $driver_id)>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>