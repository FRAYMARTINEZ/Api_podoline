<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UnauthorizedException extends Exception
{
    public function __construct($message = "No autenticado")
    {
        parent::__construct($message, Response::HTTP_UNAUTHORIZED);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
