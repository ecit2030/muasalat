<x-pages.datatable
    :title="t_('tracks')"
    route="dashboard.track.track"
    :datatable="$dataTable"
    :filter="true"
    :create="$isAdmin"
    :parameters="['id'=>request('id')]"
/>
