<?php

namespace App\Datatables\Dashboard\General;

use App\Models\Area;
use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class AreaDatatable extends BaseDatatable
{
    protected ?string $actionable = 'edit|delete|create';

    public function query(): Builder
    {
        $query = Area::query();

        $query->when(request('id'), function ($query) {
            $area = Area::find(request('id'));
            $query->where(['parent_id' => $area?->id, 'level' => $area ? $area?->level + 1 : 0]);

        })->when(! request('id'), function ($query) {
            $query->where(['level' => 0]);
        });

        return $query;
    }

    protected function getActions($model): array
    {
        $viewRoute = route($this->route.'.index', ['id' => $model]);
        $howInsideData = t_('show inside data');
        $action['view'] = view('components.datatable.includes.actions.show_button', ['route' => $viewRoute, 'target' => '', 'title' => $howInsideData]);

        $returnBack = t_('return back');

        if (session('parentAreaId')) {
            $route = route($this->route.'.index', ['id' => session('parentAreaId')]);

            $action['back'] = view('components.datatable.includes.actions.back_button', ['route' => $route, 'title' => $returnBack]);
        } elseif (request()->has('id')) {
            $route = route($this->route.'.index');
            $action['back'] = view('components.datatable.includes.actions.back_button', ['route' => $route, 'title' => $returnBack]);
        }

        return $action;
    }

    protected function getCustomColumns(): array
    {
        return [
            'flag' => function ($model) {
                $image = $model->getFirstMediaUrl('flag');

                return view('components.datatable.includes.columns.image', compact('image'));
            },

            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model->active]);
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            $this->column('title.'.app()->getLocale(), t_('name')),
            Column::computed('flag')->title(t_('flag')),
            Column::computed('active')->title(t_('status')),
        ];
    }

    protected function getFilterColumns(): array
    {
        return [
            'title.'.app()->getLocale() => CustomFilters::translated('title'),
        ];
    }
}
