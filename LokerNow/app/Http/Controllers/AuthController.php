<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|unique:users',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    Auth::login($user);

    return redirect()->intended('dashboard');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);


        if (Auth::attempt([
            'email' => $credentials['identifier'],
            'password' => $credentials['password']
        ]) || Auth::attempt([
            'username' => $credentials['identifier'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'identifier' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}