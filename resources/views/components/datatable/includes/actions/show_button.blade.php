@if(filled($route))
    <a href="{{ $route }}" target="{{ $target ?? '_blank' }}" data-toggle="tooltip" title="{{ $title ?? t_('show') }}"
       class="btn btn-icon  btn-active-color-success btn-sm me-1">
        <i class="fonticon-view fs-2 "></i>
        <!--end::Svg Icon-->
    </a>
@endif
