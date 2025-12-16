<?php

namespace App\Datatables\Dashboard\User;

use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class UserDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete|show|create';

    public function query(): Builder
    {

        return User::query()->withoutGlobalScopes()->whereKeyNot(1)->role("user")->latest();
    }

    protected function getCustomColumns(): array
    {
        return [
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model->active]);
            },
            'gender' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->info?->gender]);
            },
            'email' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->email]);
            },
            'username' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->username]);
            },
        ];
    }

    protected function getActions($model): array
    {
        $activateTitlelog = t_('activate');
        $deactivateTitlelog = t_('deactivate');
        $walletTitle = __('messages.wallet');

        if ($model->is_active) {
            $action = [
                'deactivate' => <<<HTML
            <a href='#deactivationModal' class="btn btn-icon  btn-active-color-danger btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$deactivateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-x"></i> </a></a>
            HTML
            ];
        } else {
            $action = [
                'activate' => <<<HTML
            <a href='#activationModal' class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$activateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-check"></i> </a></a>
            HTML
            ];
        }

        $action['wallet'] = <<<HTML
            <a href='#walletModal' class="btn btn-icon  btn-active-color-info btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$walletTitle}" data-bs-toggle="modal" data-bs-target="#walletModal" ><i class="fas fa-wallet"></i> </a></a>
            HTML
        ;

        return $action;
    }


    protected function getColumns(): array
    {
        return [
            Column::make('full_name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('phone')->title(t_('Phone')),
            Column::make('username')->title(t_('username')),
            Column::computed('active')->title(t_('Status')),
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
            'username' => function ($query, $keyword) {
                $query->where('username', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }
}
