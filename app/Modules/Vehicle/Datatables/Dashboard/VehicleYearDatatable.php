<?php

namespace Modules\Vehicle\Datatables\Dashboard;

use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Vehicle\Models\VehicleYear;
use Yajra\DataTables\Html\Column;

class VehicleYearDatatable extends BaseDatatable
{
    protected ?string $actionable = 'create|delete';

    public function query(): Builder
    {
        return VehicleYear::whereVehicleModelId(request("vehicle_model_id"));
    }

    protected function getColumns(): array
    {
        return [
            Column::make('year')->title(t_('year')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'year' => function ($query, $keyword) {
                $query->where('year', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }

    protected function getActions($model): array
    {
        $edit = route('modules.vehicle.dashboard.vehicle-year.edit', ['vehicle_year' => $model->id]);
        $editTitlelog = t_('title edit');

        return [
            'view' => <<<HTML
        <a href='{$edit}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$editTitlelog}" ><i class="bi bi-pen"></i> </a></a>
        HTML,
        ];
    }
}
