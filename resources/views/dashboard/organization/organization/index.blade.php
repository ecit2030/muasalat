<x-pages.datatable
    :title="t_('organization')"
    route="dashboard.organization.organization"
    :datatable="$dataTable"
    :filter="true"
    :create="true"
    :parameters="['id'=>request('id')]"
/>



<x-component.modal mark="activation"   route="dashboard.organization.activation" message="messages.r_u_sure" />

<x-component.modal mark="deactivation" route="dashboard.organization.activation" reason="true" message="messages.please_enter_the_reason" />
