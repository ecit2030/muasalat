<?php

namespace Modules\Vehicle\Datatables\Dashboard;

use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Vehicle\Models\UserVehicle;
use Yajra\DataTables\Html\Column;

class UserVehicleDatatable extends BaseDatatable
{
    protected ?string $actionable = 'create|delete';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data  = UserVehicle::latest();
        } elseif ($organization) {
            $data  = UserVehicle::whereUserId(auth()->id())->latest();
        } elseif ($moderator) {
            $data  = UserVehicle::whereUserId(auth()->user()->organization_id)->latest();
        }
        return $data;
    }

    protected function getColumns(): array
    {
        $data = [
            Column::computed('brand')->title(t_('vehicle brand')),
            Column::computed('model')->title(t_('vehicle model')),
            Column::computed('year')->title(t_('year')),
            Column::make('vehicle_number')->title(t_('vehicle number')),
            Column::computed('active')->title(t_('Status')),
        ];

        if (auth()->user()->hasRole("admin")) {
            array_push(
                $data,
                Column::make('ownerName')->title(t_('owner name'))
            );
            array_push(
                $data,
                Column::make('ownerRole')->title(t_('owner role'))
            );
        };
        return $data;
    }

    protected function getCustomColumns(): array
    {
        $data  =[
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model->is_active]);
            },
            'brand' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->year?->model?->brand?->getTranslation("name", get_current_lang())]);
            },
            'model' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->year?->model->getTranslation("name", get_current_lang())]);
            },
            'year' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->year->year]);
            }
        ];

        if (auth()->user()->hasRole("admin")) {
            $data["ownerName"] =  function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user?->name]);
            };
            $data["ownerRole"] =  function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user?->roles()?->first()?->name]);
            };
        }

        return $data;
    }

    protected function getActions($model): array
    {
        $edit = route('modules.vehicle.dashboard.user-vehicle.edit', ['user_vehicle' => $model?->id]);

        $show = route('modules.vehicle.dashboard.user-vehicle.show', ['user_vehicle' => $model?->id]);

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
        $data = [
            'year' => function ($query, $keyword) {
                $query->whereRelation('year','year', 'like', '%' . $keyword . '%');
            },
            'model' => function ($query, $keyword) {
                $query->whereHas('year',function($query) use($keyword){
                    $query->whereRelation('model','name', 'like', '%' . $keyword . '%');
                });
            },
            'brand' => function ($query, $keyword) {
                $query->whereHas('year',function($query) use($keyword){
                    $query->whereHas('model',function($query) use($keyword){
                        $query->whereRelation('brand','name', 'like', '%' . $keyword . '%');
                    });
                });
            },
        ];
        return $data;
    }
}
