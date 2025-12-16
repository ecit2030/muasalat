@props(['route' => null, 'message' => null, 'reason' => false, 'balance' =>false , "mark" => "activation" ])

<!-- Modal -->
<div class="modal fade" id="{{ $mark }}Modal" tabindex="-1" role="dialog" aria-labelledby="{{ $mark }}Modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route($route) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="text-center"> <h6 id="messageTitle"></h6></p>
                    <input type="hidden" name="model_id" id="model_id" value="">

                    <span id="error_message" style="color:red;"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ t_('cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ t_('done') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $('#{{$mark}}Modal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('user_id');
        var modal = $(this);
        modal.find('.modal-body #model_id').val(user_id);
        modal.find('.modal-body #balance').attr("max" ,  button.data('balance'));
        modal.find('.modal-body #messageTitle').text(button.data('message'));
    
    })
</script>

