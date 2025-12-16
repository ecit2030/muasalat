<x-pages.datatable
    :title="t_('captain')"
    route="dashboard.captain.captain"
    :datatable="$dataTable"
    :filter="true"
    :create="true"
    :parameters="['id'=>request('id')]"
/>



<x-component.modal mark="activation"   route="dashboard.captain.activation" message="messages.r_u_sure" />

<x-component.modal mark="deactivation" route="dashboard.captain.activation" reason="true" message="messages.please_enter_the_reason" />
