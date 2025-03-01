<?php 
namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;


use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    public function render($request,  \Throwable $exception)
    {
        
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found.',
                'message' => $exception->getMessage(),
            ], 404);
        }

       
        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Validation failed.',
                'message' => $exception->errors(),
            ], 422);
        }


        
        if ($exception instanceof HttpException) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], $exception->getStatusCode());
        }

        
        return parent::render($request, $exception);
    }
}
