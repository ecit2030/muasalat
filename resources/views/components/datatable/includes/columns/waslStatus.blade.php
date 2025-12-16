@isset($wasl_status)
    <td class="text-center">
        @if ($wasl_status == 'valid')
            <x-ui.badge :value="t_('valid')" color="success" />
        @elseif ($wasl_status == 'invalid')
            <x-ui.badge :value="t_('invalid')" color="danger" />
        @elseif ($wasl_status == 'failed')
            <x-ui.badge :value="t_('failed')" color="danger" />
        @else
            <x-ui.badge :value="t_('pending')" color="warning" />
        @endif
    </td>
@endisset
