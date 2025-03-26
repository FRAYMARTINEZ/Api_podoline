<?php

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\BadRequestException;
use App\Exceptions\DatabaseException;
use App\Exceptions\DeleteRestrictionException;

class HandleExceptionsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(Throwable $e): JsonResponse
    {
        $status = 500;
        $message = "Error interno del servidor";

        if ($e instanceof NotFoundException ||
            $e instanceof UnauthorizedException ||
            $e instanceof ForbiddenException ||
            $e instanceof BadRequestException ||
            $e instanceof DatabaseException ||
            $e instanceof DeleteRestrictionException) {
            $status = $e->getCode();
            $message = $e->getMessage();
        }

        return response()->json(['error' => $message], $status);
    }
}
