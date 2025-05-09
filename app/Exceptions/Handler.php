<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;
use Throwable;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
         // تسجيل QueryException
         $this->reportable(function (QueryException $e) {
             if ($e->getCode() === '23000') {
                 Log::channel('sql')->warning($e->getMessage());
                 return false;
             }
             return true;
         });

         // عرض QueryException
         $this->renderable(function (QueryException $e, Request $request) {
             if ($e->getCode() == 23000) {
                 $message = 'Foreign key constraint failed';
             } else {
                 $message = $e->getMessage();
             }

             if ($request->expectsJson()) {
                 return response()->json([
                     'message' => $message,
                 ], 400);
             }

             return redirect()
                 ->back()
                 ->withInput()->withErrors([
                     'message' => $e->getMessage(),
                 ])
                 ->with('info', $message);
         });

         // عرض خطأ 404 في صفحة مخصصة
         $this->renderable(function (NotFoundHttpException $e, Request $request) {
             if ($request->expectsJson()) {
                 return response()->json([
                     'message' => 'Page not found.',
                 ], 404);
             }

             // عرض صفحة 404 المخصصة
             return response()->view('front.404', [], 404);
         });
     }
 }

