<?php

namespace Modules\Analyse\Datatables\Dashboard;

use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Analyse\Models\Analyse;
use Yajra\DataTables\Html\Column;

class AnalyseDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Analyse::where('type', '<>', 'summary')->latest();
    }

    protected function getCustomColumns(): array
    {
        return [
            'done' => function ($model) {
                return view('components.datatable.includes.actions.toggle_button', ['column' => 'done', 'model' => $model]);
            },

            'message' => function ($model) {
                $title = $model->message;

                return view('components.datatable.includes.columns.title', compact('title'));
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            $this->column('type', t_('type')),
            Column::computed('done')->title(t_('done')),
            $this->column('title', t_('title')),
            $this->column('file', t_('file')),
            Column::computed('line')->title(t_('line')),
            Column::computed('message')->title(t_('message')),
        ];
    }
}
