<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|exists:users,password',
        ],
        [
            'username.required' => 'username harus di isi',
            'password.exists' => 'username salah',
            'password.required' => 'password harus di isi',
            'password.exists' => 'password salah',

        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->route('login')->with('error', 'username atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
