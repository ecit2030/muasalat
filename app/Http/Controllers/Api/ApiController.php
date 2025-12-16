<?php

namespace App\Http\Controllers\Api;

use App\Support\Api\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    protected string $routeName;

    protected string $model;

    protected string $resource;

    protected string $formRequest;

    protected int $per_page = 10;

    protected int $page = 1;

    protected bool $indexPagination = true;

    protected bool $showData = true;

    protected bool $indexData = true;

    public function __construct()
    {
    }

    public function successfulRequest(
        ?string $route = null,
        ?array $routeParams = [],
        bool $asJson = false,
    ): JsonResponse {
        return self::apiResponse();
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

    protected function validationAction($key = null): array
    {
        return isset($this->formRequest) && class_exists($this->formRequest) ?
            app($this->formRequest)->validated($key) : request()->validate($this->rules());
    }

    protected function queryBuilder(): Builder
    {
        return $this->model::query();
    }
}
