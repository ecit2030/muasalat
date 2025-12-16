<?php

namespace App\Support\Api\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait WithForm
{
    public function create()
    {
        self::apiCode(200)->apiMessage(t_('create page'));

        return $this->apiPage();
    }

    public function edit($id)
    {
        $model = $this->model::findOrFail($id);

        self::apiCode(200)->apiMessage(t_('edit page'));

        return $this->apiPage(model: $model);
    }

    public function apiPage(array $data = [], ?Model $model = null): \Illuminate\Http\JsonResponse
    {
        $model && self::apiBody([Str::lower(class_basename($model)) => $this->resource::make($model)]);
        self::apiBody($this->formData($model));
        self::apiInfo('from withFormTrait -> apiPage');

        return self::apiResponse();
    }

    protected function formData(?Model $model = null): array
    {
        return [];
    }
}
