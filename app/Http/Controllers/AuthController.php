<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription
        ]);
    }

    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau password salah.',])->onlyInput('email');
        }

        $loginRequest->session()->regenerate();
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
