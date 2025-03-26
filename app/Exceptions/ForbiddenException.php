<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ForbiddenException extends Exception
{
    public function __construct($message = "No tienes permisos para realizar esta acción")
    {
        parent::__construct($message, Response::HTTP_FORBIDDEN);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
