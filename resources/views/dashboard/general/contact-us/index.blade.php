<x-pages.datatable
    :title="t_('contact us')"
    :createTitle="$title"
    route="dashboard.general.contact-us"
    :datatable="$dataTable"
    :parameters="['id'=>request('id')]"
/>
