<x-pages.datatable
    :title="t_('vehicle index')"
    :createTitle="$title"
    route="modules.vehicle.dashboard.user-vehicle"
    :datatable="$dataTable"
    :create="$isAdmin"
    :parameters="['id'=>request('id')]"
/>
