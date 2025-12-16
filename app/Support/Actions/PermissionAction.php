<?php

namespace App\Support\Actions;

use Illuminate\Routing\Controller;
use Spatie\Enum\Laravel\Enum;

class PermissionAction extends Enum
{
    /**
     * @param  Controller  $controller
     */
    public function resource(Controller $controller): void
    {
        $controller->middleware(['permission:'.$this->create()])->only(['create', 'store']);
        $controller->middleware(['permission:'.$this->view()])->only(['index', 'show']);
        $controller->middleware(['permission:'.$this->edit()])->only(['edit', 'update']);
        $controller->middleware(['permission:'.$this->delete()])->only(['destroy']);
    }

    /**
     * @param  string  $ability  ['create', 'view', 'edit', 'delete']
     * @param  Controller  $controller
     * @param  array  $methods
     */
    public function middleware(string $ability, Controller $controller, array $methods = []): void
    {
        $controller->middleware(['permission:'.$this->{$ability}])->only($methods);
    }

    public function view(): string
    {
        return 'view_'.$this->value;
    }

    public function create(): string
    {
        return 'create_'.$this->value;
    }

    public function edit(): string
    {
        return 'edit_'.$this->value;
    }

    public function delete(): string
    {
        return 'delete_'.$this->value;
    }

    /**
     * @param  string  $ability  ['create', 'view', 'edit', 'delete']
     * @param  null  $guard
     *
     * @return bool
     */
    protected function can(string $ability, $guard = null): bool
    {
        return auth($guard)->user()?->can($this->{$ability}()) ?? false;
    }
}
