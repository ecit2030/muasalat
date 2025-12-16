<?php

namespace App\Datatables\Dashboard\General;

use App\Models\ApplicationCategory;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class ApplicationCategoryDatatable extends BaseDatatable
{
    protected ?string $actionable = 'edit';
    public function query(): Builder
    {
        return ApplicationCategory::latest();
    }

    protected function getActions($model): array
    {
        $actions = [];
        if ($model->getKey() > 6) {
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
        ];
    }
    protected function getColumns(): array
    {
        return [
            Column::computed('title')->title(t_('title')),
        ];
    }
}
