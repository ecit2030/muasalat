<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Datatables\Dashboard\General\PagesDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\General\PageRequest;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\StaticPage\Entities\StaticPage;

class PageController extends DashboardController
{
    use WithDatatable, WithForm;

    protected string $routeName = 'dashboard.general.pages';
    protected string $viewPath  = 'dashboard.general.pages';

    protected string $formRequest  = PageRequest::class;

    protected string $permissions = 'static_page';
    protected string $model = StaticPage::class;

    protected string $datatable = PagesDatatable::class;

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }
 
    protected function store(Request $request)
    {
        $permissionList = PermissionsList::create([
            'title' => [
                'ar' => $request->title['ar'],
                'en' => $request->title['en'],
            ],
            'content' => 'aa',
        ]);

        return redirect()->route("dashboard.general.pages.index");
    }

    protected function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|array',
            'title.*' => 'required|string',
            'content' => 'required|array',
            'content.*' => 'required|string'
        ])->validated();

        $this->model::findOrFail($id)->update($validated);

        return redirect()->route("dashboard.general.pages.index");
    }

    protected function formData(?Model $model = null): array
    {
        return [
            'model' => $model,
        ];
    }
}
