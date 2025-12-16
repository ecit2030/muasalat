<x-pages.datatable
    :title="t_('organization')"
    route="dashboard.organization.organizationRequest"
    :datatable="$dataTable"
    :filter="true"
    :parameters="['id'=>request('id')]"
/>
