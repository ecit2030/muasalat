<x-pages.datatable
    :title="t_('drivers')"
    route="dashboard.driver.driver"
    :datatable="$dataTable"
    :filter="true"
    :create="$isAdmin"
    :parameters="['id'=>request('id')]"
/>



<x-component.modal mark="activation"   route="dashboard.driver.activation" message="messages.r_u_sure" />

<x-component.modal mark="deactivation" route="dashboard.driver.activation" reason="true" message="messages.please_enter_the_reason" />


<div class="modal fade" id="veichleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLveichleModalabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('Veichle')</h5>
      </div>
      <div class="modal-body">
        <p id="currentDrievrCar" style="display:none;"></p>
      <form method="POST" action="{{route('dashboard.driver.assignVeichle')}}">
      @csrf
       <input type="hidden" name="model_id" id="model_id" value="">
        <div class="form-group">
            <label for="veichle">@lang('Choose Veichle')</label>
            <select name="veichle" id="veichle" class="form-control">
                <option value="">@lang('Choose Veichle')</option>
                @foreach($cars as $car)
                    <option value="{{$car->id}}">{{$car->vehicle_letter}} - {{$car->vehicle_number}}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <button type="submit" class="btn btn-primary">@lang('Save')</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $('#veichleModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('user_id');
        var car = button.data('car');
        var modal = $(this);
        modal.find('.modal-body #model_id').val(user_id);
        if(car){
            $('#currentDrievrCar').show().text(car);
        }else{
            $('#currentDrievrCar').hide().text('');
        }
    })
</script>