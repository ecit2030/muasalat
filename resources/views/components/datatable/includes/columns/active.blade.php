@isset($active)
    <td class="text-center">
        @if ($active)
            <x-ui.badge :value="__('messages.active')" color="success"/>
        @else
            <x-ui.badge :value="__('messages.not active')" color="danger"/>
        @endif
    </td>
@endisset
