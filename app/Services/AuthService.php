<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function login(array $credentials)
    {

        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return $this->userRepository->respondWithToken($token);
    }

    public function logout()
    {
        return $this->userRepository->logout();
    }

    public function refresh()
    {
        return $this->userRepository->refresh();
    }

    public function getUserCurrent()
    {
        return $this->userRepository->getUserCurrent();
    }

    public function respondWithToken($token)
    {

        return $this->userRepository->respondWithToken($token);
    }
    // Otros métodos relacionados con la autenticación
}
