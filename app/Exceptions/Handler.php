<?php

namespace App\Exceptions;

use App\Support\Api\ApiResponse;
use BadMethodCallException;
use Error;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    protected $levels = [

    ];

    protected $dontReport = [

    ];

    protected string $infoType = 'from exception handler';

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            
            if ($exception instanceof ValidationException) {
                $errors = $exception->errors();
                $message = '';
                foreach ($errors as $key => $error) {
                    $message = $error[0];
                    $this->apiBody([$key => $error[0]]);
                }
                $this->apiMessage($message)
                    ->apiInfo("{$this->infoType} ValidationException {$exception->getMessage()}");

                return self::apiResponse();
            }
            if ($exception instanceof TokenMismatchException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} TokenMismatchException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof NotFoundHttpException) {
                $this->apiMessage(t_('this request is not found'))
                    ->apiInfo("{$this->infoType} NotFoundHttpException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof HttpException) {
                $exception->getStatusCode() === 200 ? $this->apiCode(200) : 400;
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} HttpException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof Error) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} TypeError File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof TypeError) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} TypeError File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof ErrorException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} ErrorException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof InvalidArgumentException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} InvalidArgumentException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} MethodNotAllowedHttpException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof BadMethodCallException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} BadMethodCallException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof InvalidArgumentException) {
                $this->apiMessage($exception->getMessage())
                    ->apiInfo("{$this->infoType} InvalidArgumentException File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof ModelNotFoundException) {
                $this->apiMessage(t_('There are no results for your :model search query', ['model' => class_basename($exception->getModel())]))
                    ->apiInfo("{$this->infoType} ModelNotFoundException {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof ItemNotFoundException) {
                $this->apiMessage(t_('There are item not found'))
                    ->apiInfo("{$this->infoType} ItemNotFoundException {$exception->getTraceAsString()} File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }
            if ($exception instanceof QueryException) {
                $this->apiMessage(t_($exception->getMessage()));
                if ($exception->getCode() === 23000) {
                    $this->apiMessage(t_('You cannot erase data because it is connected to other data'));
                }
                $this->apiInfo("{$this->infoType} ModelNotFoundException {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");

                return self::apiResponse();
            }

        } elseif (strpos(request()->url(), '/') === false &&
            ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException)) {
            return response()->view('Common::404', ['type' => 404]);
        }

        return parent::render($request, $exception);
    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    protected function unauthenticated(
        $request,
        AuthenticationException $exception
    ): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse
    {
        $this->apiMessage(t_('please login first'))
            ->apiInfo('From ExceptionHandler unauthenticated function');

        return $request->expectsJson()
            ? self::apiResponse()
            : redirect()->guest($exception->redirectTo());
    }
}
