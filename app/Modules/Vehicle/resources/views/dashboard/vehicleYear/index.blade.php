<x-pages.datatable
    :title="t_('vehicle year')"
    :createTitle="$title"
    route="modules.vehicle.dashboard.vehicle-year"
    :datatable="$dataTable"
    :create="true"
    :mapping="$mapping"
    :parameters="['vehicle_model_id'=>request('vehicle_model_id')]"
/>
