<?php

namespace Modules\Vehicle\Datatables\Dashboard;

use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Modules\Vehicle\Models\VehicleBrand;
use Yajra\DataTables\Html\Column;

class VehicleBrandDatatable extends BaseDatatable
{
    protected ?string $actionable = 'create|delete';

    public function query(): Builder
    {
        return VehicleBrand::query();
    }

    protected function getColumns(): array
    {
        return [
            Column::computed('name')->searchable()->title(t_('name')),
        ];
    }

    protected function getCustomColumns(): array
    {
        return [
            'name' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->getTranslation("name" , get_current_lang())]);
            },
        ];
    }

    protected function getActions($model): array
    {
        $edit = route('modules.vehicle.dashboard.vehicle-brand.edit', ['vehicle_brand' => $model->id]);

        $show = route('modules.vehicle.dashboard.vehicle-brand.show', ['vehicle_brand' => $model->id]);

        $editTitlelog = t_('title edit');
        $showTitlelog = t_('title show');

        return [

            'show' => <<<HTML
             <a href='{$show}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$showTitlelog}" ><i class="bi bi-eye"></i>  </a>
          </a>

        HTML,

            'view' => <<<HTML
        <a href='{$edit}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$editTitlelog}" ><i class="bi bi-pen"></i> </a></a>
        HTML,
        ];
    }


    protected function getFilters(): array
    {
        return [
            'name' => CustomFilters::translated('name'),
        ];
    }
}
