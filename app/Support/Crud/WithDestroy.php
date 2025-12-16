<?php

namespace App\Support\Crud;

use Illuminate\Database\Eloquent\Model;

trait WithDestroy
{
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);

        $this->code = 200;
        $this->message = t_('Data has been deleted successfully');

        $action = $this->destroyAction($model);

        return $action ?? $this->successfulRequest(asJson: true);
    }
    protected function destroyAction(Model $model)
    {
        $model->delete();

        return null;
    }
}
