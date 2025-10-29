<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
