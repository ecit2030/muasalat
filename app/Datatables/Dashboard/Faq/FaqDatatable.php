<?php

namespace App\Datatables\Dashboard\Faq;

use App\Models\Faq;
use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class FaqDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete|edit|create';
    public function query(): Builder
    {
        return Faq::query();
    }

    protected function getCustomColumns(): array
    {
        return [

            'localQuestion' => function ($model) {
                return view('components.datatable.includes.columns.title', [ "title" => $model->getTranslation("question" , requestLang())]);
            },

            'localAnswer' => function ($model) {
                return view('components.datatable.includes.columns.title', [ "title" =>$model->getTranslation("answer" , requestLang())]);
            },

        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('localQuestion')->title(t_('question')),
            Column::make('localAnswer')->title(t_('answer')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'localQuestion' => CustomFilters::translated('question'),
            'localAnswer' => CustomFilters::translated('answer'),
        ];
        return $data;
    }
}
