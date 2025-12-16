<x-pages.datatable
    :title="t_('vehicle model')"
    :createTitle="$title"
    route="modules.vehicle.dashboard.vehicle-model"
    :datatable="$dataTable"
    :create="true"
    :mapping="$mapping"
    :parameters="['vehicle_brand_id'=>request('vehicle_brand_id')]"
/>
