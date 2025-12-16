<?php

namespace App\Support\Crud;

trait WithStore
{
    public function store()
    {
        $this->code = 200;
        $this->message = 'Request executed successfully';

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
