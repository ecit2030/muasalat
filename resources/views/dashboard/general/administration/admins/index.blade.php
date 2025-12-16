<x-pages.datatable
        :title="t_('Admins')"
        route="dashboard.general.administration.admins"
        :datatable="$dataTable"
        :create="true"

/>





<x-component.modal mark="activation"   route="dashboard.general.administration.admin.acivation" message="messages.r_u_sure" />

<x-component.modal mark="deactivation" route="dashboard.general.administration.admin.acivation" reason="true" message="messages.please_enter_the_reason" />
