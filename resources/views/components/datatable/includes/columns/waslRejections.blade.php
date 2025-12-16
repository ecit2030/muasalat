<a id="rejections_open_model{{ $id }}" class="btn btn-icon btn-danger" data-bs-toggle="modal"
   data-bs-target="#rejections_model{{ $id }}">
    <i class="bi bi-chat-square-text-fill"></i>
</a>
<div class="modal fade" id="rejections_model{{ $id }}" tabindex="-1" role="dialog"
     aria-labelledby="rejections_model_label{{ $id }}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ t_('wasl rejections') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @isset($wasl_rejections)
                @forelse($wasl_rejections as $rejection)
                <span class="fs-2 pt-4">
                     <strong class="text-danger">{{ __('moltaqa-wasl::messages.'.$rejection) }}</strong>
                </span>
                @if(!$loop->last)
                <br>
                <hr>
                @endif
                @empty
                <span class="fs-2 pt-4">
                     <strong class="text-success">{{ __('no rejections found') }}</strong>
                </span>
                @endforelse
                @endisset
            </div>
        </div>
    </div>
</div>