<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Użytkownik został pomyślnie zarejestrowany.',
                'user' => $user,
            ], 201);
        }

        return redirect()->route('login.view')->with('success', 'Rejestracja zakończona sukcesem. Możesz się teraz zalogować.');
    }

    /**
     * Handle user login.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Zalogowano pomyślnie.',
                    'user' => Auth::user(),
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Zalogowano pomyślnie.');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Nieprawidłowe dane logowania.',
            ], 401);
        }

        return redirect()->route('login.view')->withErrors([
            'email' => 'Podano nieprawidłowe dane logowania.',
        ]);
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Wylogowano pomyślnie.',
            ]);
        }

        return redirect()->route('login.view')->with('success', 'Wylogowano pomyślnie.');
    }
}
