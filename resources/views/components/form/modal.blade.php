@props(['title','route','id'=>null,'js-validator'=>null,'parameters'=>[]])


<div class="modal bg-white fade" tabindex="-1" id="{{$id}}_modal_form">
    <div class="modal-dialog modal-sm">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action=""></form>
            {!! Form::open([ 'id'=>'form-modal','route'=>$route,'files'=>true])!!}
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


{{$modelScripts ?? ""}}
