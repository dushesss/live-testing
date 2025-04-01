<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }

    public function login(array $credentials): array|null
    {
        $user = User::where('login', $credentials['login'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
