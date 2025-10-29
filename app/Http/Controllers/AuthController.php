<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {}

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if ($this->authService->attemptLogin($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('home'));
            }

            return back()->withErrors([
                'email' => 'Credenciales inválidas.',
            ])->onlyInput('email');

        } catch (\Throwable $e) {
            return back()->with('error', 'Ocurrió un error al iniciar sesión.');
        }
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
