<x-pages.datatable
    :title="t_('Roles')"
    route="dashboard.general.administration.roles"
    :datatable="$dataTable"
    :create="true"

/>

<x-component.activation mark="activation"   route="dashboard.general.administration.role.activation" message="messages.r_u_sure" />

<x-component.activation mark="deactivation" route="dashboard.general.administration.role.activation" reason="true" message="messages.please_enter_the_reason" />
