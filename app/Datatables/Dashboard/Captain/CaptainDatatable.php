<?php

namespace App\Datatables\Dashboard\Captain;

use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CaptainDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete|show|edit|create';

    public function query(): Builder
    {
        return User::query()->withoutGlobalScopes()->whereKeyNot(1)->role("captain")->whereStatus("active")->latest() ;
    }

    protected function getCustomColumns(): array
    {
        return [
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model->is_active ? true : false]);
            },
        ];
    }


    protected function getActions($model): array
    {
        $activateTitlelog = t_('activate');
        $deactivateTitlelog = t_('deactivate');

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
        return [];

        return $action ;
    }


    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('phone')->title(t_('Phone')),
            Column::computed('active')->title(t_('Status')),
            // Column::computed('gender')->title(t_('gender')),
        ];
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
