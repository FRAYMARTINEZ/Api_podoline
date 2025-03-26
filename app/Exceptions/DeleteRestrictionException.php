<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DeleteRestrictionException extends Exception
{
    public function __construct($message = "No se puede eliminar este recurso debido a restricciones de integridad")
    {
        parent::__construct($message, Response::HTTP_CONFLICT);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
