<?php

namespace App\Datatables\Dashboard\Driver;

use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class DriverDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete|show|edit|create';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = User::query()
                ->withoutGlobalScopes()
                ->whereKeyNot(1)
                ->has('driverOrg')
                ->role("captain")
                ->latest();
        } elseif ($organization) {
            $data = User::query()
                ->withoutGlobalScopes()
                ->whereOrganizationId(auth()->user()->id)
                ->whereKeyNot(1)
                ->role("captain")
                ->latest();
        } elseif ($moderator) {
            $data = User::query()
                ->withoutGlobalScopes()
                ->whereOrganizationId(auth()->user()->organization_id)
                ->whereKeyNot(1)
                ->role("captain")
                ->latest();
        }

        return $data;
//        if (auth()->user()->hasRole(["organization"])) {
//
//            return User::query()
//                ->withoutGlobalScopes()
//                ->whereOrganizationId(auth()->user()->id)
//                ->whereKeyNot(1)
//                ->whereHas('roles', function ($q) {
//                    $q->whereName("driver");
//                })->latest();
//        } else {
//
//            return User::query()
//                ->withoutGlobalScopes()
//                ->whereKeyNot(1)
//                ->whereHas('roles', function ($q) {
//                    $q->whereName("driver");
//                })->latest();
//        }
    }

    protected function getCustomColumns(): array
    {
        $data  = [
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model->is_active ? true : false]);
            }
        ];

        if (auth()->user()->hasRole("admin")) {
            $data["orgName"] =  function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => User::find($model->organization_id)?->name]);
            };
        }

        return $data;
    }

    protected function getActions($model): array
    {
        $activateTitlelog = t_('activate');
        $deactivateTitlelog = t_('deactivate');
        $veichleTitlelog = __('Veichle');

        if ($model->is_active) {
            $action = [
                'deactivate' => <<<HTML
            <a href='#deactivationModal' class="btn btn-icon  btn-active-color-danger btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$deactivateTitlelog}" data-bs-toggle="modal" data-bs-target="#deactivationModal" ><i class="fas fa-x"></i> </a></a>
            HTML
            ];
        } else {
            $action = [
                'activate' => <<<HTML
            <a href='#activationModal' class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$activateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-check"></i> </a></a>
            HTML
            ];
        }
        $car = $model->driverVehicle ?? null;
        $stringCar = $car ?  (__('the current car is') .' '.$car->vehicle_letter . ' - ' . $car->vehicle_number) : null;
        $action['veichle'] = <<<HTML
            <a href='#veichleModal' data-car="$stringCar" class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$veichleTitlelog}" data-bs-toggle="modal" data-bs-target="#veichleModal" ><i class="fas fa-car"></i> </a></a>
            HTML;

        return $action;
    }


    protected function getColumns(): array
    {
        $data = [
            Column::make('name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('phone')->title(t_('Phone')),
            Column::computed('active')->title(t_('Status')),
        ];
        if (auth()->user()->hasRole("admin")) {
            array_push(
                $data,
                Column::make('orgName')->title(t_('organization name'))
            );
        };
        return $data;
    }

    protected function getFilters(): array
    {
        $data = [
            'name' => function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            },
            'email' => function ($query, $keyword) {
                $query->where('email', 'like', '%' . $keyword . '%');
            },
            'phone' => function ($query, $keyword) {
                $query->where('phone', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }
}
