<?php

namespace App\Support\Api\Crud;

use Illuminate\Database\Eloquent\Model;

trait WithUpdate
{
    public function update($id)
    {
        $model = $this->model::findOrFail($id);
        $validated = $this->validationAction();

        self::apiCode(200)->apiMessage(t_('data has been updated successfully'));

        $action = $this->updateAction($validated, $model);

        return $action ?? $this->successfulRequest();
    }
    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        return null;
    }
}
