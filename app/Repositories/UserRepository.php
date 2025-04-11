<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole($data["role"]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function logout($request)
    {
        return  $request->user()->currentAccessToken()->delete();
    }

    public function refresh($request)
    {
        $user = $request->user();

        // Revocamos el token actual
        $request->user()->currentAccessToken()->delete();

        // Creamos un nuevo token
        $token = $user->createToken('refresh_token')->plainTextToken;

        return [
            'token' => $token,
        ];
    }

    public function getUserCurrent()
    {
        $user = Auth::user();
        return [
            'user' => $user->with(['roles.permissions'])
                ->where('id', Auth::id())
                ->first(),
        ];
    }
    public function login($credentials, $ip, $device_name)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }
        $user->tokens()->delete();

        $device = $device_name ?? $ip;
        $token = $user->createToken($device)->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function all()
    {
        return User::with('office')->withTrashed()->paginate(15);
    }

    public function find(int $id): ?User
    {
        return User::findOrFail($id);
    }

    public function update(int $id, array $data): User
    {
        $user = User::findOrFail($id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function restore(int $id): ?User
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
        }

        return $user;
    }
}
