<?php

namespace Modules\Vehicle\Datatables\Dashboard;

use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Vehicle\Models\VehicleRequest;
use Yajra\DataTables\Html\Column;

class VehicleRequestDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = VehicleRequest::latest();
        } elseif ($organization) {
            $data = VehicleRequest::whereUserId(auth()->id())->latest();
        } elseif ($moderator) {
            $data = VehicleRequest::whereUserId(auth()->user()->organization_id)->latest();
        }
        return $data;
    }

    protected function getColumns(): array
    {
        return [
            Column::make('user')->title(t_('user')),
            Column::make('content')->title(t_('content')),
            Column::make('status')->title(t_('status')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'content' => function ($query, $keyword) {
                $query->where('content', 'like', '%' . $keyword . '%');
            },
            'user' => function ($query, $keyword) {
                $query->whereRelation('user', 'name', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }

    protected function getCustomColumns(): array
    {
        return [
            'user' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->user->name]);
            },
            'status' => function ($model) {
                return view('components.datatable.includes.columns.vehicleRequest', ['status' => $model->status]);
            }
        ];
    }

    protected function getActions($model): array
    {
        $show = route('modules.vehicle.dashboard.vehicle-request.show', ['vehicle_request' => $model->id]);
        $showTitlelog = t_('title show');

        if (auth()->user()->hasRole(["admin"]) && $model?->status == "pending") {
            $edit = route('modules.vehicle.dashboard.vehicle-request.edit', ['vehicle_request' => $model->id]);
            $editTitlelog = t_('title edit');
            return [
                'show' => <<<HTML
        <a href='{$show}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$showTitlelog}" ><i class="bi bi-eye"></i> </a></a>
        HTML,
                'view' => <<<HTML
        <a href='{$edit}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$editTitlelog}" ><i class="bi bi-pen"></i> </a></a>
        HTML,
            ];
        } else {
            return [
                'show' => <<<HTML
        <a href='{$show}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$showTitlelog}" ><i class="bi bi-eye"></i> </a></a>
        HTML,
            ];
        }
    }
}
