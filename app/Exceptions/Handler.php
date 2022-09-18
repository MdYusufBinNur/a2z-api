<?php

namespace App\Exceptions;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     * @param Exception|Throwable $e
     * @return void
     * @throws Throwable
     */

    public function report(Exception|Throwable $e): void
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception|Throwable $e
     * @return JsonResponse
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e): JsonResponse
    {
        if ($e instanceof AuthorizationException) {
            return response()->json((['status' => 403, 'message' => 'Insufficient privileges to perform this action.']),
                403);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json((['status' => 405, 'message' => 'Method Not Allowed.']), 405);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json((['status' => 404, 'message' => 'Resource not found with the specific id.']), 404);
        }

        if ($e instanceof NotFoundHttpException || $e instanceof RouteNotFoundException) {
            // log it in bugsnag
            Bugsnag::notifyException($e);
            return response()->json((['status' => 404, 'message' => 'The requested resource was not found.']), 404);
        }

        if ($e instanceof AccessDeniedHttpException) {
            return response()->json((['status' => 403, 'message' => "Access Denied."]),
                403);
        }

        if ($e instanceof InvalidArgumentException) {
            return response()->json((['status' => 403, 'message' => $e->getMessage()]),
                403);
        }

        return parent::render($request, $e);
    }
}
