<?php

namespace App\Exceptions;

use Exception;

class CategoryNotAvailableException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Category not available',
            'message' => 'The category you are trying to access is no longer available.',
        ], 200);
    }
}

