<?php

namespace App\Support\Crud;

use Illuminate\Support\Str;

trait WithDatatable
{
    public function index()
    {
        $this->viewPath ??= $this->routeName;
        $breadcrumbs = Str::of($this->routeName)
            ->explode('.')
            ->map(fn ($i) => __(Str::studly($i)))
            ->push(__('Show All'));
        $data = array_merge([
            'route' => $this->routeName,
            'breadcrumbs' => $breadcrumbs,
        ], $this->indexData());

        return $this->datatable::create($this->routeName)->render("{$this->viewPath}.index", $data);
    }

    protected function indexData(): array
    {
        return [];
    }
}
