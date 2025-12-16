<x-pages.datatable
    :title="t_('vehicle brand')"
    :createTitle="$title"
    route="modules.vehicle.dashboard.vehicle-brand"
    :datatable="$dataTable"
    :create="true"
    :parameters="['id'=>request('id')]"
/>
