<x-pages.datatable
    :title="t_('captain')"
    route="dashboard.captain.captainRequest"
    :datatable="$dataTable"
    :filter="true"
    :parameters="['id'=>request('id')]"
/>
