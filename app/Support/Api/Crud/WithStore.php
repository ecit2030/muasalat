<?php

namespace App\Support\Api\Crud;

trait WithStore
{
    public function store()
    {
        self::apiCode(200)->apiMessage(t_('Request executed successfully'));

        $validated = $this->validationAction();
        $action = $this->storeAction($validated);

        return $action ?? $this->successfulRequest();
    }
    protected function storeAction(array $validated)
    {
        $this->model::create($validated);

        return null;
    }
}
