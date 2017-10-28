<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        AuthenticationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     *  * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     * 
     * @param Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \Exception                  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof NotFoundHttpException) {
            if ($request->ajax() || $request->wantsJson()) {
                return $this->responseData($e);
            }

            return response()->view('errors.404', [], 404);
        }

        if ($e instanceof ForbiddenException) {
            if ($request->ajax() || $request->wantsJson()) {
                return $this->responseData($e);
            }

            return response()->view('errors.403', ['message' => $e->getMessage()], 404);
        }

        if ($e instanceof TokenMismatchException) {

            // dd('token mismatched');
            
            return redirect()->back()->withError('Your session was expired');

        } 


        if ($e instanceof NoContentException) {
            if ($request->ajax() || $request->wantsJson()) {
                return $this->responseData($e);
            }
        }

        if ($e instanceof ModelNotFoundException) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'     => false,
                    'message'     => $e->getMessage(),
                    'status_code' => $e->getCode(),
                ], 200);
            }

            return response()->view('errors.404', ['message' => $e->getMessage()], 404);
        }

        if ($e instanceof InternalServerErrorException) {
            if ($request->ajax() || $request->wantsJson()) {
                return response(['error' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }

            return response()->view('errors.404', ['message' => $e->getMessage()], 500);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->view('errors.404', ['message' => $e->getMessage()], 404);
            }
            return response()->view('errors.404', [], 404);
        }

        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        } elseif ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        } elseif ($e instanceof AuthorizationException) {
            $e = new HttpException(403, $e->getMessage());
        } elseif ($e instanceof ValidationException && $e->getResponse()) {
            return $e->getResponse();
        }

        // if(env('APP_ENV') != 'local'){

        //     return response()->view('errors.myerror', ['title' => 'Looks like you found a BUG, help us to fix it by clicking the REPORT ERROR button below!', 'message' => 'Something Went Wrong!', 'maileable' => 'yes', 'e' => $e]);
        // }

        return parent::render($request, $e);
    }

    public function responseData($e, $code = 404, $message = 'Page not found')
    {
        $data = [
            "error" => $e->getMessage() ?: $message,
            "code"  => $e->getCode() ?: $code,
        ];

        return response($data, $data['code']);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
