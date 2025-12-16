<?php

namespace App\Support\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait WithUpdate
{
    public function update($id)
    {
        $model = $this->model::findOrFail($id);
        request('trigger_action') && $this->triggerAction($model);

        $validated = $this->validationAction();
        $action = $this->updateAction($validated, $model);

        self::apiCode(200)->apiMessage(t_('request executed successfully'));

        return $action ?? $this->successfulRequest();
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        return null;
    }

    protected function triggerAction(Model $model)
    {
        $validate = request()->validate([
            'type' => 'required|string',
            'value' => 'required',
        ]);
        $model->update([data_get($validate, 'type') => data_get($validate, 'value')]);

        abort(200, t_(
            ':model status is :value',
            ['value' => request('value') ? t_('active') : t_('not active'), 'model' => Str::snake(class_basename($model))]
        ));

        return self::apiResponse();
    }
}
