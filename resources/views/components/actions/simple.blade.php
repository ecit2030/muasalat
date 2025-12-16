@props(['id'=>null,'route'=>[],'empty'=>false])
@php($routesList = is_array($route) ? $route : null)
<td class="table-report__action w-56 border-b">
    <div class="flex justify-center items-center">
        {{ $slot }}
        @if(!$empty)
            <a class="flex items-center mr-3"
               href="{{$routesList['edit'] ?? route($route.'.edit',$id)}}">
                <i data-feather="check-square" class="w-4 h-4 mx-1"></i>
                {{ t_('Edit') }}
            </a>
            <a class="flex items-center text-theme-6 delete" href="javascript:;"
               data-delete-url="{{$routesList['delete'] ?? route($route.'.destroy',$id)}}">
                <i data-feather="trash-2" class="w-4 h-4 mx-1"></i>
                {{ t_('Delete') }}
            </a>
        @endif
    </div>
</td>
