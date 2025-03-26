<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class BadRequestException extends Exception
{
    public function __construct($message = "Petición incorrecta")
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
