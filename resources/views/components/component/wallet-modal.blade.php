@props(['route' => null, 'message' => null, 'reason' => false, 'balance' =>false , "mark" => "activation" ])

<!-- Modal -->
<div class="modal fade" id="{{ $mark }}Modal" tabindex="-1" role="dialog" aria-labelledby="{{ $mark }}Modal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @csrf
            <div class="modal-body">
                <p class="text-center"> <h6>{{ t_($message) }}</h6></p>
                <input type="hidden" name="model_id" id="model_id" value="" class="userId">

                <h4>@lang('messages.current balance') : <span id="balanceSpan"></span></h4>

                <div class="form-group">
                    <label>@lang('messages.amount')</label>
                    <input type="number" name="balance" required min="0" max="" id="userBalance" class="form-control"/>
                </div>

                <span id="errorSpan" style="color:red;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ t_('cancel') }}</button>
                <button id="depositBalance" class="btn btn-primary balanceAction">{{ __('messages.deposit') }}</button>
                <button id="discountBalance"
                        class="btn btn-primary balanceAction">{{ __('messages.discount') }}</button>
            </div>

        </div>
    </div>
</div>


<script>
    $('#{{$mark}}Modal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('user_id');
        var modal = $(this);
        modal.find('.modal-body #model_id').val(user_id);
        modal.find('.modal-body #userBalance').attr("max", button.data('balance'));
        $('#balanceSpan').text(0)
        $.ajax({
            url: `{{ route('dashboard.user.user.get.balance') }}`,
            type: "GET",
            dataType: 'JSON',
            data: {
                "id": `${user_id}`
            },
            success: function (res) {
                $('#balanceSpan').text(res.balance)
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }
        });

    })

    $('.balanceAction').on('click', function (event) {
        event.preventDefault()
        let type = $(this).attr('id');
        let user_id = $('.userId').val();
        let amount = $('#userBalance').val();
        $('#errorSpan').text('')
        $.ajax({
            url: `{{ route('dashboard.user.user.update.balance') }}`,
            type: "POST",
            dataType: 'JSON',
            data: {
                "id": `${user_id}`,
                "type": `${type}`,
                "amount": `${amount}`,
            },
            success: function (res) {
                swal.fire("{{__('messages.balance updated')}}", "{{__('messages.balance updated')}}", "success");
                $('#{{$mark}}Modal').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#userBalance').val('');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $('#errorSpan').text(XMLHttpRequest.responseJSON.body.amount)
            }
        });

    })

</script>

