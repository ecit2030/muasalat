<?php

namespace App\Http\Controllers\Frontend;

use App\Support\Api\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    protected string $routeName;

    protected string $route;

    protected string $model;

    protected int $per_page = 10;

    protected int $page = 1;

    protected bool $pagination = true;

    public function successfulRequest(
        ?string $route = null,
        ?array $routeParams = [],
        bool $asJson = false
    ): RedirectResponse|JsonResponse {
        if ($asJson || request()->expectsJson()) {
            return self::apiResponse();
        }
        toast(t_('Request executed successfully'), 'success');

        return redirect()->route($route ? $route : "{$this->routeName}.index", $routeParams);
    }

    public function validation(Request $request)
    {
        $class = $request->class;
        $class = str_replace('.', '\\', $class);
        $my_request = new $class();
        $validator = Validator::make($request->all(), $my_request->rules(), $my_request->messages(), ['method' => $request->getMethod()]);

        $validator->setAttributeNames($my_request->attributes());
        if ($request->ajax()) {
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray(),
                ]);
            }

            return response()->json([
                'status' => true,
            ]);
        }
    }

    /**
     * @description List of rules to validate the incoming requests
     *
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    protected function validationAction(): array
    {
        return request()->validate($this->rules());
    }

    protected function queryBuilder(): Builder
    {
        return $this->model::query();
    }
}
