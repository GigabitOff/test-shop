<?php

namespace App\Exceptions;

use App\Http\Middleware\Authenticate;
use App\Traits\JsonResponseFormat;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use JsonResponseFormat;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  Request  $request
     * @param AuthenticationException $exception
     * @return Response
     */
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        if ($request->expectsJson() || $this->isApiRoute($request)) {
            return response()->json([
                'success' => 'error',
                'message' => $exception->getMessage(),
                'content' => []
            ], 401);
        }

        if (session('session_expired')) {
            return redirect()
                ->guest($exception->redirectTo() ?? route('main'))
                ->with('show_message_popup', 'session_expired');
        }

        return $this->shouldReturnJson($request, $exception)
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest($exception->redirectTo() ?? route('main'));
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param ValidationException $e
     * @param Request $request
     * @return Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request): Response
    {
        if ($request->expectsJson() || $this->isApiRoute($request)) {
            return $this->error($e->getMessage(), 422, $e->errors());
        }
        return parent::convertValidationExceptionToResponse($e, $request);
    }
    /**
     * Check for api routes.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiRoute(Request $request): bool
    {
        return $request->route() && in_array('api', $request->route()->middleware());
    }

    /**
     * @param Request $request
     * @param ValidationException $exception
     * @return JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return $this->error($exception->getMessage(), $exception->status, $exception->errors());
    }
}
