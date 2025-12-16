<?php

namespace App\Datatables\Dashboard\ContactUs;

use App\Models\ContactUs;
use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class ContactUsDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show';

    public function query(): Builder
    {
        $query = ContactUs::query()->latest();
        return $query;
    }

    protected function getCustomColumns(): array
    {
        return [
            'reply' => function ($model) {
                return view('components.datatable.includes.columns.reply', ['reply' => $model->is_replied]);
            }
        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->searchable()->title(t_('name')),
            Column::make('email')->searchable()->title(t_('email')),
            Column::computed('reply')->title(t_('Status')),
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
        ];
        return $data;
    }
}
