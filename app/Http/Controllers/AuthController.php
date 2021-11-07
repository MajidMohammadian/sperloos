<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;

class AuthController extends Controller
{
    public function index()
    {
        if(auth()->id()) {
            return redirect()->intended('post');
        }

        return view('login');
    }

    public function login(Login $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('post');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->intended('login');
    }
}
