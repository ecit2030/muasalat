<?php

namespace App\Support\Crud;

use Collective\Html\FormFacade;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

trait WithForm
{
    public function create(): View|\Illuminate\Http\JsonResponse
    {
        return request()->expectsJson() ? $this->apiPage() : $this->formPage();
    }

    public function edit($id)
    {
        $model = $this->model::findOrFail($id);

        return request()->expectsJson() ? $this->apiPage(model: $model) : $this->formPage(model: $model);
    }

    public function formPage(array $data = [], ?Model $model = null): View
    {
        $model && FormFacade::setModel($model);
        $data['model'] = $model;
        $data['route'] = $this->routeName;
        $this->viewPath ??= $this->routeName;

        return view("{$this->viewPath}.form", array_merge($this->formData($model), $data));
    }

    public function apiPage(array $data = [], ?Model $model = null): \Illuminate\Http\JsonResponse
    {
        $this->body = array_merge($this->formData($model), $data);

        $this->body['model'] = $model;
        $this->body['route'] = $this->routeName;

        return self::apiResponse();
    }

    protected function formData(?Model $model = null): array
    {
        return [];
    }
}
