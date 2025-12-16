<?php

namespace Modules\Analyse\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Actions\ChartJsAction;
use App\Support\Crud\WithCrud;
use Illuminate\Support\Arr;
use Modules\Analyse\Datatables\Dashboard\AnalyseDatatable;
use Modules\Analyse\Models\Analyse;

class AnalyseController extends DashboardController
{
    use WithCrud;

    protected string $routeName = 'modules.analyse.dashboard.analysis';

    protected string $viewPath = 'Analyse::dashboard.analysis';

    protected string $model = Analyse::class;

    protected string $datatable = AnalyseDatatable::class;

    private ?array $data = [];

    protected function rules()
    {
        return [
            'done' => 'nullable',
        ];
    }

    protected function storeAction(array $validated)
    {
        $this->getArrayData();
        collect($this->data)->chunk(30)->map(function ($chank) {
            $this->model::insert($chank->toArray());
        });
    }

    private function getArrayData()
    {
        $translationsArray = file_exists(base_path('insights.json')) ? json_decode(file_get_contents(base_path('insights.json')), true) : [];

        $this->data[] = [
            'type'         => 'summary',
            'done'         => null,
            'status'       => null,
            'title'        => null,
            'insightClass' => null,
            'file'         => null,
            'diff'         => null,
            'line'         => null,
            'message'      => null,
            'data'         => json_encode(Arr::pull($translationsArray, 'summary')),
        ];
        foreach ($translationsArray as $index => $valueArray) {
            if (is_array($valueArray)) {
                foreach ($valueArray as $key => $value) {
                    if (is_array($value)) {
                        $this->data[] = [
                            'type'         => $index,
                            'done'         => data_get($value, 'done'),
                            'status'       => data_get($value, 'status'),
                            'title'        => data_get($value, 'title'),
                            'insightClass' => data_get($value, 'insightClass'),
                            'file'         => data_get($value, 'file'),
                            'diff'         => data_get($value, 'diff'),
                            'line'         => data_get($value, 'line'),
                            'message'      => data_get($value, 'message'),
                            'data'         => null,
                        ];
                    }
                }
            }
        }
    }

    protected function indexData(): array
    {

        return ['chartJs' => $this->chartJs()];
    }

    private function chartJs()
    {
        $summary = $this->model::whereType('summary')->first();

        return ChartJsAction::new('CodeAnalyse')
                            ->type('bar')
                            ->size(['width' => 400, 'height' => 80])
                            ->labels([__('Analyses summery')])
                            ->datasets([
                                [
                                    "label"           => __("Code"),
                                    'backgroundColor' => [$this->color(data_get($summary?->data, 'code'))],
                                    'data'            => [data_get($summary?->data, 'code')],
                                ],
                                [
                                    "label"           => __("Complexity"),
                                    'backgroundColor' => [$this->color(data_get($summary?->data, 'complexity'))],
                                    'data'            => [data_get($summary?->data, 'complexity')],
                                ],
                                [
                                    "label"           => __("architecture"),
                                    'backgroundColor' => [$this->color(data_get($summary?->data, 'architecture'))],
                                    'data'            => [data_get($summary?->data, 'architecture')],
                                ],
                                [
                                    "label"           => __("Style"),
                                    'backgroundColor' => [$this->color(data_get($summary?->data, 'style'))],
                                    'data'            => [data_get($summary?->data, 'style')],
                                ],
                            ]);
    }

    protected function color(float $value = null)
    {
        $color = 'red';
        if ($value > 50) {
            $color = 'coral';
        }
        if ($value > 70) {
            $color = 'yellow';
        }
        if ($value > 90) {
            $color = 'green';
        }

        return $color;
    }
}
