$(document).ready(function () {

    $(document).on('click', '.btn-trigger', function () {
        let that = $(this);

        let id = that.data('id');
        let type = that.data('type') || '';
        let model = that.data('model') || '';

        swal.fire({
            title: trans('are you sure ?'),
            text: trans('to change the status of this statement'),
            type: 'warning',
            color: "#716add",
            showCancelButton: true,
            confirmButtonText: trans('yes, make a change'),
            cancelButtonText: trans('no, cancel')
        }).then((isConfirm) => {
            if (isConfirm.value) {
                $.post(`${window.routes}${id}`, {
                    _method: 'PATCH',
                    type: type,
                    trigger_action : type,
                    value: (that.prop('checked') === true) ? 1 : 0
                }).done(function (response) {
                    if (response.status) {
                        $('.datatable-ajax').DataTable().ajax.reload();
                        swal.fire(trans("good job"), response.message, "success");
                    }
                }).fail(function (response) {
                    $('.datatable-ajax').DataTable().ajax.reload();
                    swal.fire(trans("failed to delete"), response.responseJSON.message, "error");
                })
            }
        });
    });

    $(document).on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        let that = $(this);
        swal.fire({
            // title: trans('Are you sure ?'),
            text: trans('You wont be able to restore it again'),
            color: "#716add",
            showCancelButton: true,
            confirmButtonText: trans('Yes, delete'),
            cancelButtonText: trans('No, cancel')
        }).then((isConfirm) => {
            if (isConfirm.value) {
                $.post(window.routes + id, {_method: 'DELETE'}).done(function (response) {
                    if (response.status) {
                        $('.datatable-ajax').DataTable().ajax.reload();
                        swal.fire(
                            {
                                title: trans("good job"),
                                text: trans('data deleted'),
                                type: 'success',
                                color: "#716add",
                                showCancelButton: false,
                                confirmButtonText: trans('ok'),
                                cancelButtonText: trans('no, cancel')
                            }
                        );
                    }
                }).fail(function (response) {
                    swal.fire(trans("failed to delete"), response.responseJSON.message, "error");
                })
            }
        });
    });

});


function datatableInitComplete(settings, json) {

    var baseTable = window.LaravelDataTables[settings.sInstance];
    $('.custom_filter').on('change', function () {
        baseTable.draw();
    });
    refreshFsLightbox();
}

function datatableDrawCallback(settings, json) {
    refreshFsLightbox();
    // ___________TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();
    // colored tooltip
    $('[data-toggle="tooltip-primary"]').tooltip({
        template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
    });
    $('[data-toggle="tooltip-secondary"]').tooltip({
        template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
    });

    var query = window.location.search.substring(1);
    var vars = query.split("=");
    if (vars[0] === 'id') {
        var ID = vars[1];
        if (ID) {
            var elment = $('#' + ID);
            elment.addClass('bg-danger selected')
            elment.remove()
            $("tbody").prepend(elment);
            console.log(elment)
            elment.focus();
        }
    }
}
