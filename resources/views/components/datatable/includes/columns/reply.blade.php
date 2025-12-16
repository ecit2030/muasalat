@isset($reply)
    <td class="text-center">
        @if ($reply)
            <x-ui.badge :value="t_('answered')" color="success"/>
        @else
            <x-ui.badge :value="t_('not reply')" color="danger"/>
        @endif
    </td>
@endisset
