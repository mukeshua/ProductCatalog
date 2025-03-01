<?php

namespace App\Exceptions;

use Exception;

class ProductNotAvailableException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Product not available',
            'message' => 'The product you are trying to access is no longer available.',
        ], 400);
    }
}

