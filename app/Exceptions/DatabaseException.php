<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DatabaseException extends Exception
{
    public function __construct($message = "Error en la base de datos")
    {
        parent::__construct($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
