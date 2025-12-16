<?php

namespace App\Datatables\Dashboard\Captain;

use App\Http\Requests\Dashboard\Captain\CaptainRequest;
use App\Models\JoinRequest;
use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CaptainRequestDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show|delete';

    protected string $route = 'dashboard.Captain.CaptainRequest';

    public function query(): Builder
    {
        return User::whereStatus("pending")->role("captain")->latest();
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('Name')),
            Column::make('email')->title(t_('Email')),
            Column::make('phone')->title(t_('Phone')),
            Column::make('wasl_status')->title(t_('wasl status')),
            Column::computed('wasl_rejections')->title(t_('wasl rejections')),
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
            'wasl_status' => function ($query, $keyword) {
                $query->where('wasl_status', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }

    protected function getCustomColumns(): array
    {
        return [
            'wasl_status' => function ($model) {
                return view('components.datatable.includes.columns.waslStatus', ['wasl_status' => $model?->wasl_status]);
            },
            'wasl_rejections' => function ($model) {
                return view('components.datatable.includes.columns.waslRejections',
                    ['wasl_rejections' => $model?->wasl_rejections, "id" => $model?->id]
                );
            },
        ];
    }
}
