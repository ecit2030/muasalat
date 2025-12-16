<x-pages.datatable
    :title="t_('vehicle request')"
    :createTitle="$title"
    route="modules.vehicle.dashboard.vehicle-request"
    :datatable="$dataTable"
    :parameters="['id'=>request('id')]"
/>
