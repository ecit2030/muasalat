
@php

    $status = request('status');

    if ($status == 'pending') {
        $result = 'wallet pending';
    } elseif ($status == 'accepted') {
        $result = 'wallet accepted';
    } elseif ($status == 'declined') {
        $result = 'wallet declined';
    } else {
        $result = 'wallet';
    }
@endphp


<x-pages.datatable :title="t_($result)" {{-- :create="true" --}} route="dashboard.wallet.wallet" :datatable="$dataTable" />



<x-component.modal mark="activation"   route="dashboard.wallet.wallet.accept" message="messages.r_u_sure" />

<x-component.modal mark="deactivation" route="dashboard.wallet.wallet.decline" reason="true" message="messages.please_enter_the_reason" />
