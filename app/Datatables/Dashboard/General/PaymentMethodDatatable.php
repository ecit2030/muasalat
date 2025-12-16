<?php

namespace App\Datatables\Dashboard\General;

use App\Models\PaymentMethod;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class PaymentMethodDatatable extends BaseDatatable
{
    protected ?string $actionable = 'edit';
    public function query(): Builder
    {
        return PaymentMethod::query();
    }
    protected function getActions($model): array
    {
        $actions = [];
        if ($model->getKey() > 2) {
            $titleEdit = t_('title view');
            $actions[] = <<<HTML
                      <a href='javascript:;' data-id='{$model->getKey()}' class="mr-2 btn btn-outline-danger btn-delete btn-sm"  data-placement="top" data-toggle="tooltip" title="{$titleEdit}">
                            <i class="las la-trash la-2x"></i>
                      </a>
            HTML;
        }
        return $actions;
    }
    protected function getCustomColumns(): array
    {
        return [
            'title' => function ($model) {
                $title = $model->title;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'code' => function ($model) {
                $title = $model->code;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'description' => function ($model) {
                $title = $model->description;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
            'active' => function ($model) {
                $active = $model->active;

                return view('components.datatable.includes.columns.active', compact('active'));
            },

        ];
    }

    protected function getColumns(): array
    {
        return [

            Column::computed('title')->title(t_('title')),
            Column::computed('description')->title(t_('description')),
            Column::computed('code')->title(t_('code')),
            Column::computed('data')->title(t_('data')),
            Column::computed('active')->title(t_('active')),

        ];
    }
}
