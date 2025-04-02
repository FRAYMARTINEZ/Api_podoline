<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;


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

    public function login(array $credentials, $ip, $device_name)
    {
        $credentials = request(['email', 'password']);
        return $this->userRepository->login($credentials, $ip, $device_name);
    }

    public function logout($request)
    {
        return $this->userRepository->logout($request);
    }

    public function refresh($request)
    {
        return $this->userRepository->refresh($request);
    }

    public function getUserCurrent()
    {
        return $this->userRepository->getUserCurrent();
    }
    // Otros métodos relacionados con la autenticación
}
