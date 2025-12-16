<?php

namespace App\Datatables\Dashboard\Organization;

use App\Http\Requests\Dashboard\Organization\OrganizationRequest;
use App\Models\JoinRequest;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class OrganizationRequestDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show|delete';

    protected string $route = 'dashboard.organization.organizationRequest';

    public function query(): Builder
    {
        return JoinRequest::query()->latest();
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('phone')->title(t_('Phone')),
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
