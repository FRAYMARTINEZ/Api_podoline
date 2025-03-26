<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function logout();
    public function refresh();
    public function getUserCurrent();
    public function respondWithToken(string $token);

    // Otros métodos que necesites
}
