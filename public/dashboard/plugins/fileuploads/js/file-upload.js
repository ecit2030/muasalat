var dropifyElements = {};

var drEvent = $('.dropify').dropify({
    messages: {
        'default': trans('Drag and drop a file here or click'),
        'replace': trans('Drag and drop or click to replace'),
        'remove': trans('Remove'),
        'error': trans('Ooops, something wrong appended.')
    },
    error: {
        'fileSize': trans('The file size is too big (2M max).')
    }
});

drEvent.each(function () {
    dropifyElements[this.id] = true;
});

drEvent.on('dropify.beforeClear', function (event, selected) {
    id = event.target.id;
    if (dropifyElements[id]) {
        swal.fire({
            title: trans('are you sure ?'),
            text: trans('to delete this file'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: trans('yes, delete it'),
            cancelButtonText: trans('no, cancel')
        }).then((res) => {
            if (res.isConfirmed) {
                const element = $(selected.element);
                var file_uuid = element.data('uuid');
                if (file_uuid) {
                    $.post(window.deleteFileRoute, {
                        _method: 'POST',
                        uuid: file_uuid,
                    }).done(function (response) {
                        console.log(response)

                        if (response.status) {

                            swal.fire(trans("good job"), response.message, "success");
                        }
                    }).fail(function (response) {
                        swal.fire(trans("Error"), response.responseJSON.message, "error");
                    })

                }
                selected.value = "";
                selected.resetPreview();
            }
            if (res.dismiss === 'cancel') {
                swal.fire({
                    title: trans('cancelled'),
                    text: trans('delete cancelled'),
                    type: "error",
                    timer: 2000,
                });
            }
        });
        return false;
    }
});


