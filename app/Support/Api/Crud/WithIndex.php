<?php

namespace App\Support\Api\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait WithIndex
{
    public function index()
    {
        if ($this->indexData) {
            $this->indexPagination ? $this->dataWithPagination() : $this->dataWithoutPagination();
        }

        self::apiCode(200)
            ->apiMessage(t_('Request executed successfully'))
            ->apiBody($this->indexAction());

        return self::apiResponse();
    }

    public function show($id)
    {
        $model = $this->model::findOrFail($id);
        $this->showData && self::apiBody([Str::snake(class_basename($model)) => $this->resource::make($model)]);

        self::apiCode(200)
            ->apiMessage('Request executed successfully')
            ->apiBody($this->showAction($model));

        return self::apiResponse();
    }

    protected function indexFilterAction(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->queryBuilder();
    }

    protected function indexAction(): array
    {
        return [];
    }

    protected function showAction(?Model $model = null): array
    {
        return [];
    }

    private function dataWithPagination()
    {
        self::apiBody([
            Str::plural(Str::snake(class_basename($this->model))) => $this->resource::paginate($this->indexFilterAction()->paginate(request('per_page', 10))),
        ]);
    }

    private function dataWithoutPagination()
    {
        self::apiBody([
            Str::snake(class_basename($this->model).'s') => $this->resource::collection($this->indexFilterAction()->get()),
        ]);
    }
}
