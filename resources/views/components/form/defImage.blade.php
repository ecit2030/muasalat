@props([ 'name','value'=> "",'uuid'=> '' ,'col_size'=>12, 'label'=>null,'info'=>null,'label_class'=>''])
@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
@endphp

<div @class(["col-sm-$col_size",'my-6']) >
    <div class="parsley-input @error(dotted_string($name)) parsley-error @enderror mb-1 ">

        @if($label)
            <label class="d-flex align-items-center fs-5 fw-semibold {{$label_class}} {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
                <span class="{{ data_get($attributes,'required') ? 'required':'' }} form-label">   {{ $label }}</span>
                @if($info)
                    <i class="fas fa-exclamation-circle ms-2 fs-7"
                       data-bs-toggle="tooltip"
                       data-bs-custom-class="tooltip-inverse"
                       data-bs-placement="top"
                       title="{{$info}}"></i>
                @endif
            </label>

        @endif

        <input type="file" name="{{$name}}"
               @if($value)
               data-default-file="{{$value?:asset("storage/default/no-image.png")}}"
               @else
               value="{{old(dotted_string($name))}}"
               @endisset
               @if($uuid)
               data-uuid="{{$uuid}}"
               @endisset
               class="{{ $invalidClass }} dropify"/>
        @error(dotted_string($name))
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('styles')

    <!---Internal Fileupload css-->
    <link href="{{asset("dashboard/plugins/fileuploads/css/fileupload.css")}}" rel="stylesheet" type="text/css"/>

    <!---Internal Fancy uploader css-->
    <link href="{{asset("dashboard/plugins/fancyuploder/fancy_fileupload.css")}}" rel="stylesheet"/>

@endpush

@push('scripts')
    <script>
        window.deleteFileRoute = "{{ route('modules.delete.file.by.uuid') }}";
    </script>
    <!--Internal Fileuploads js-->
    <script src="{{asset('dashboard/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('dashboard/plugins/fileuploads/js/file-upload.js')}}"></script>

@endpush
