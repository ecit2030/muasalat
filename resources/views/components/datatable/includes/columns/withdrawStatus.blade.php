@isset($status)
    <td class="text-center">
        @if ($status == 'accepted')
            <x-ui.badge :value="t_('active')" color="success" />
        @elseif ($status == 'declined')
            <x-ui.badge :value="t_('not active')" color="danger" />
        @else
            <x-ui.badge :value="t_('pending')" color="warning" />
        @endif
    </td>
@endisset
