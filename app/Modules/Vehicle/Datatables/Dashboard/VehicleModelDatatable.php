<?php

namespace Modules\Vehicle\Datatables\Dashboard;

use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Modules\Vehicle\Models\VehicleModel;
use Yajra\DataTables\Html\Column;

class VehicleModelDatatable extends BaseDatatable
{
    protected ?string $actionable = 'create|delete';

    public function query(): Builder
    {
        return VehicleModel::whereVehicleBrandId(request("vehicle_brand_id"));
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('name')),
            Column::make('capacity')->title(t_('capacity')),
        ];
    }

    protected function getCustomColumns(): array
    {
        return [
            'name' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->getTranslation("name" , get_current_lang())]);
            },
            'capacity' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->capacity]);
            },
        ];
    }

    protected function getActions($model): array
    {
        $edit = route('modules.vehicle.dashboard.vehicle-model.edit', ['vehicle_model' => $model->id]);

        $show = route('modules.vehicle.dashboard.vehicle-model.show', ['vehicle_model' => $model->id]);

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
