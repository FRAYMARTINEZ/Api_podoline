<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function create(array $data): array;
    public function login($credentials, $ip, $device_name);
    public function logout(Request $request);
    public function refresh(Request $request);
    public function getUserCurrent();
    // Otros métodos que necesites
}
