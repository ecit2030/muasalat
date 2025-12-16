<?php

namespace App\Http\Controllers\Dashboard\Faq;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\Faq;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Datatables\Dashboard\Faq\FaqDatatable;
use App\Http\Requests\Dashboard\Faq\StoreFaqRequest;

class FaqController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.faqs.faqs';
    protected string $viewPath  = 'dashboard.faqs.faqs';

    protected string $datatable = FaqDatatable::class;
    protected string $formRequest = StoreFaqRequest::class;

    protected string $permissions = 'faq';

    protected string $model = Faq::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $Faq = $this->model::findOrFail($id);

        return view($this->routeName . '.show', compact('Faq'));
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

    protected function storeAction(array $validated)
    {
        $this->queryBuilder()->create($validated);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);
    }


    protected function formData(?Model $model = null):array
    {
        return [
            "model" => $model
        ];
    }
}
