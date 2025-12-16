<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\Report;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use App\Datatables\Dashboard\Report\ReportDatatable;

class ReportController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.reports.reports';
    protected string $viewPath  = 'dashboard.reports.reports';

    protected string $datatable = ReportDatatable::class;

    protected string $permissions = 'report';

    protected string $model = Report::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $model = $this->model::findOrFail($id);
        return view($this->routeName . '.show', get_defined_vars());
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

}
