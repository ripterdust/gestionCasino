<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            "mail" => 'required|unique:users,email',
            'password' => 'required|min:5',
            'name' => 'required'
        ]);

        // Creating the model
        $user = new User;
        $user->email = $request->mail;
        $user->password = $request->password;
        $user->name = $request->name;
        // Saving
        $user->save();

        auth()->login($user);

        return redirect()->to('/');
    }
}
