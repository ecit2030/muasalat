<x-pages.datatable
    :title="t_('User')"
    route="dashboard.user.users"
    :datatable="$dataTable"
    :filter="true"
    :parameters="['id'=>request('id')]"
/>

<x-component.modal mark="activation" route="dashboard.user.user.activation" message="messages.r_u_sure" />

<x-component.wallet-modal mark="wallet" route="dashboard.user.user.activation" message="messages.current balance" />
