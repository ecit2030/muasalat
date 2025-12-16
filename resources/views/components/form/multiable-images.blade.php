@aware(["model","name"=>"images_collection[]" , "collectionName"=>"images"])
<!-- Main content -->
@push('styles')
    <link href="{{asset('dashboard/vendors/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@isset($model)
    @if($model && $model->getMedia($collectionName)->count())
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">{{t_('Images')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach( $model->getMedia($collectionName) as $image)
                                <div class="col-sm-2">
                                    <a href="{{$image->getUrl()}}" target="_blank"

                                       style=" display: inline-block; position: relative" data-toggle="lightbox"
                                       data-title="{{$image->file_name}}" data-gallery="gallery">

                                        <img src="{{$image->getUrl()}}" class="img-fluid mb-2" alt="{{$image->file_name}}"/>
                                        <a class="delete-image" data-model_id="{{$model->getKey()}}" data-image_uuid="{{ $image->uuid }}">
                                            <i class="far fa-trash-alt fa-1x text-danger"></i>
                                        </a>

                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endisset

<!-- /.content -->
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{t_('add more image')}}
                    <small>{{t_('upload image files only')}} {{t_('you can drag and drop')}}</small></h3>
            </div>
            <div class="card-body">
                <div id="actions" class="row">

                    <div class="col-lg-6">
                        <div class="btn-group w-100">
                            <span class="btn btn-success col fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>{{t_('add images')}}</span>
                            </span>
                            <a class="btn btn-warning col cancel">
                                <i class="fas fa-times-circle"></i>
                                <span>{{t_('cancel upload')}}</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="fileupload-process w-100">
                            <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;"
                                     data-dz-uploadprogress></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table table-striped files" id="previews">
                    <div id="image_drop_zone" class="row mt-2">
                        <div class="col-auto">
                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail/></span>
                        </div>
                        <div class="col d-flex align-items-center">
                            <p class="mb-0">
                                <span class="lead" data-dz-name></span>
                                (<span data-dz-size></span>)
                            </p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                                 aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;"
                                     data-dz-uploadprogress></div>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center dz-remove">
                            <a href="javascript:undefined;" data-dz-remove="">{{t_('delete file')}}</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>

@push('scripts')

    <script>
        var uploadedDocumentMap = {}
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = true

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#image_drop_zone")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)


        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{ route('modules.upload.file') }}", // Set the url
            maxFilesize: 2,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name.slice(0, 20);
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",

            timeout: 50000,
            removedfile: function (file) {
                const response_obj = JSON.parse(file.xhr.response);
                console.log(response_obj);
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('modules.delete.file.by.uuid') }}',
                    data: {uuid: response_obj.body.file.uuid},
                    success: function (response) {
                        console.log(response);
                        $(`#${response.body.file.uuid}`).remove();
                        toastr_info(response.message);
                    },
                    error: function (e) {
                        toastr_error(e)
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                console.log(response);
                $('form').append(`<input  type="hidden" name="{{$name}}" value="${response.body.collection}" id="${response.body.file.uuid}">`)
                uploadedDocumentMap[file] = response.body.file;
                console.log(uploadedDocumentMap);
                console.log(response.body.file.uuid);
                toastr_info(response.message)
            },
            error: function (file, response) {
                console.log(response)
                toastr_error(response)
                return false;
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 2,
            previewTemplate: previewTemplate,
            autoQueue: true, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.

            dictDefaultMessage: trans("Drop files here to upload"),
            dictFallbackMessage: trans("Your browser does not support drag'n'drop file uploads."),
            dictFallbackText: trans("Please use the fallback form below to upload your files like in the olden days."),
            {{--dictFileTooBig : "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",--}}
            dictInvalidFileType: trans("You can't upload files of this type."),
            {{--dictResponseError : "Server responded with {{statusCode}} code.",--}}
            dictCancelUpload: "{{t_('cancel upload')}}",
            dictCancelUploadConfirmation: "{{t_('Are you sure you want to cancel this upload?')}}",
            dictRemoveFile: "{{t_("delete file")}}",
            dictMaxFilesExceeded: "{{t_("You can not upload any more files.")}}",
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function (file) {

            $('button[type=submit]').attr('disabled', true);

            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            // file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0"
            $('button[type=submit]').attr('disabled', false);
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.

        document.querySelector("#actions .cancel").onclick = function () {
            myDropzone.removeAllFiles(true)
            $('button[type=submit]').attr('disabled', false);

        }
        // DropzoneJS Demo Code End
    </script>


    <script>
        $('.delete-image').on('click', function () {

            var elm = $(this);
            $.ajax({
                url: "{{ route('modules.delete.file.by.uuid') }}",
                method: 'post',
                data: {
                    uuid: $(this).attr('data-image_uuid'),
                    _token: "{{ csrf_token() }}",
                    dataType: "JSON"
                },
                success: function (res) {
                    elm.closest("div").fadeOut(300);
                    toastr_info(res.message)
                },
                error: function (res) {
                    toastr_error(res.responseJSON.message)
                }
            })
        })
    </script>

@endpush
