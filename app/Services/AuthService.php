<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;


class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->all();
    }


    public function register(array $data)
    {
        return $this->userRepository->create($data);
    }
    public function update(int $id, array $data): ?User
    {
        return $this->userRepository->update($id, $data);
    }

    public function find(int $id): User
    {
        return $this->userRepository->find($id);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
    public function restore(int $id): ?User
    {
        return $this->userRepository->restore($id);
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
