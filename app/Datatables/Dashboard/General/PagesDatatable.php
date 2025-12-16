<?php

namespace App\Datatables\Dashboard\General;

use Modules\StaticPage\Entities\StaticPage;
use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class PagesDatatable extends BaseDatatable
{
    protected ?string $actionable = 'edit';

    public function query(): Builder
    {
        return StaticPage::query();
    }


    protected function getCustomColumns(): array
    {
        return [
            'name' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->getTranslation("title", get_current_lang())]);
            },
            // 'content' => function ($model) {
            //     return view('components.datatable.includes.columns.title', ['title' => $model->content[get_current_lang()] ]);
            // },
        ];
    }
    protected function getColumns(): array
    {
        return [
            Column::make('name')->title(t_('name')),
            // Column::make('content')->title(t_('content')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'name' => CustomFilters::translated('name'),
        ];
        return $data;
    }
}
