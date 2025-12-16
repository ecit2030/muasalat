<?php

namespace App\Datatables\Dashboard\General\Administration;

use App\Enums\General\RolesEnum;
use App\Models\Role;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class RolesDatatable extends BaseDatatable
{
    protected ?string $actionable = 'view|edit|delete';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        $data = Role::whereGuardName('dashboard')
            ->whereNotIn('name', RolesEnum::toArray());

        if ($admin) {
            $data->withCount('permissions')->withCount('users');
        }
        if ($organization) {
            $data->whereOwnerId(auth()->id())
                ->withCount('permissions')->withCount('users');
        }
        if ($moderator) {
            $data->whereOwnerId(auth()->user()->organization_id)
                ->withCount('permissions')->withCount('users');
        }

        return $data;
    }
    protected function getActions($model): array
    {
        $activateTitlelog = t_('activate');
        $deactivateTitlelog = t_('deactivate');
        $usersCount = $model->users->count();

        if ($model->is_active) {
            if($model->users->count()){
                $message = __('The permission is linked to the system administrator, do you want to complete the disabling process?');
            }else{
                $message = __('Do you want to complete the deactivation process?');
            }
            $action = [
                'deactivate' => <<<HTML
            <a href='#deactivationModal' data-message="$message" class="btn btn-icon  btn-active-color-danger btn-sm me-1 fs-5" data-users_count="$usersCount" data-toggle="tooltip" data-user_id="$model->id" title="{$deactivateTitlelog}" data-bs-toggle="modal" data-bs-target="#deactivationModal" ><i class="fas fa-x"></i> </a></a>
            HTML
            ];
        } else {
            $activeMessage = __('Do you want to complete the activation process?');
            $action = [
                'activate' => <<<HTML
            <a href='#activationModal' data-message="$activeMessage" class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-users_count="usersCount" data-toggle="tooltip" data-user_id="$model->id" title="{$activateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-check"></i> </a></a>
            HTML
            ];
        }

        return $action;
    }

    protected function getColumns(): array
    {
        return array_merge([

            Column::make('name')->title(t_('Name')),
            Column::make('permissions_count')->title(t_('Permissions Count'))
                ->searchable(false)
                ->orderable(false),

            Column::make('users_count')->title(t_('Users Count'))
                ->searchable(false)
                ->orderable(false),

        ], parent::getColumns());
    }

    protected function getFilters(): array
    {
        return [
            'name' => function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            },
        ];
    }
}
