<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class NotFoundException extends Exception
{
    public function __construct($message = "Recurso no encontrado")
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
