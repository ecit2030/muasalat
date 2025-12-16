<x-pages.datatable
        :title="$title"
        :createTitle="$title"
        route="dashboard.general.areas"
        :datatable="$dataTable"
        :create="true"
        :parameters="['id'=>request('id')]"
/>
