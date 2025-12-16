@isset($status)
    <td class="text-center">
        @if ($status == 'approved')
            <x-ui.badge :value="__('Approved')" color="success" />
        @elseif ($status == 'rejected')
            <x-ui.badge :value="__('Rejected')" color="danger" />
        @else
            <x-ui.badge :value="__('Pending')" color="warning" />
        @endif
    </td>
@endisset
