<?php

namespace App\Datatables\Dashboard\General;

use App\Models\Currency;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CurrencyDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Currency::query();
    }

    protected function getCustomColumns(): array
    {
        return [
            'title' => function ($model) {
                $title = $model->title;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'exchange_rate' => function ($model) {
                $title = $model->exchange_rate;

                return view('components.datatable.includes.columns.title', compact('title'));
            },

            'code' => function ($model) {
                $title = $model->code;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'symbol' => function ($model) {
                $title = $model->symbol;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'active' => function ($model) {
                $active = $model->active;

                return view('components.datatable.includes.columns.active', compact('active'));
            },
            'default' => function ($model) {
                $default = $model->default;

                return view('components.datatable.includes.columns.default', compact('default'));
            },

        ];
    }

    protected function getColumns(): array
    {
        return [

            Column::computed('title')->title(t_('title')),
            Column::computed('exchange_rate')->title(t_('exchange rate')),
            Column::computed('code')->title(t_('code')),
            Column::computed('symbol')->title(t_('symbol')),
            Column::computed('active')->title(t_('active')),
            Column::computed('default')->title(t_('default')),

        ];
    }
}
