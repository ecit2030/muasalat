<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Datatables\Dashboard\General\AreaDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\General\AreaRequest;
use App\Models\Area;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AreaController extends DashboardController
{
    use  WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.general.areas';
    protected string $viewPath = 'dashboard.general.areas';

    protected string $datatable = AreaDatatable::class;

    protected string $permissions = 'area';

    protected string $model = Area::class;

    protected string $formRequest = AreaRequest::class;

    public function index()
    {
        $area = $this->model::findOrFail(request('id'));
        $this->handleDatatableBackAction($area);

        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "{$this->areaTitleLevelName($area ? $area->level + 1 : 0)} {$area?->title}",
        ]);
    }

    protected function storeAction(array $validated)
    {
        $flag = Arr::pull($validated, 'flag');
        $area = $this->model::findOrFail($validated['parent_id']);
        $validated['level'] = $area ? $area->level + 1 : 0;
        $area = $this->queryBuilder()->create($validated);
        $flag && uploadMedia('flag', $flag, $area);

        return $this->successfulRequest("{$this->viewPath}.index", ['id' => $validated['parent_id']]);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $flag = Arr::pull($validated, 'flag');
        $model->update($validated);
        $flag && uploadMedia('flag', $flag, $model);

        return $this->successfulRequest("{$this->viewPath}.index", ['id' => $validated['parent_id']]);
    }

    protected function formData(?Model $model = null): array
    {
        $area = $model ? $model->parent : $this->model::findOrFail(request('id'));

        return [
            'model' => $model,
            'title' => "{$this->areaLevelName($area ? $area->level + 1 : 0)} {$area?->title}",
            'parent_id' => $area?->id,
        ];
    }

    private function areaTitleLevelName($level_number)
    {
        return [
            $level_number => t_('unknown'),
            0 => t_('countries'),
            1 => t_('governorates'),
            2 => t_('cities'),
            3 => t_('regions'),
            4 => t_('provinces'),
            5 => t_('streets'),
        ][$level_number];
    }

    private function areaLevelName($level_number)
    {
        return [
            $level_number => t_('unknown'),
            0 => t_('country'),
            1 => t_('governorate in'),
            2 => t_('city in'),
            3 => t_('region in'),
            4 => t_('province in'),
            5 => t_('street in'),
        ][$level_number];
    }

    private function handleDatatableBackAction($area)
    {
        session()->forget('parentAreaId');
        if ($area?->parent_id) {
            session()->put('parentAreaId', $area->parent_id);
        }
    }
}
