<?php

namespace App\Datatables\Dashboard\General\Administration;

use App\Enums\General\RolesEnum;
use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class AdminsDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show|edit|delete';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");
        $super = auth()->user()->hasRole("super");
        if ($admin) {
            $data = User::whereKeyNot(1)->role('admin')->latest()->withoutGlobalScopes();
        } elseif ($organization) {
            $data = User::role("moderator")->whereOrganizationId(auth()->id())->latest()->withoutGlobalScopes();
        } elseif ($moderator) {
            $data = User::role("moderator")->whereOrganizationId(auth()->user()->organization_id)->where("id", "!=", auth()->id())->latest()->withoutGlobalScopes();
        } elseif ($super) {
            $data = User::whereKeyNot(1)->latest()->withoutGlobalScopes();
        }
        return $data;
    }


    protected function getCustomColumns(): array
    {
        return [
            'role' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->roles()->first()->name]);
            },
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model?->active]);
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

        return $action;
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('role')->title(t_('Role')),
            Column::computed('active')->title(t_('active')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'name' => function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            },
            'role' => function ($query, $keyword) {
                $query->whereRelation('roles', 'name', $keyword);
            },
            'email' => function ($query, $keyword) {
                $query->where('email', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }
}
