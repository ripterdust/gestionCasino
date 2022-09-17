<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    // Login
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'Correo o contraseña erróneos'
            ]);
        }

        return redirect()->route('home');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
