<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            "email" => 'required|unique:users,email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'name' => 'required'
        ]);

        // Creating the model
        $user = new User;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->name = $request->name;
        $user->coins = 0;
        // Saving
        $user->save();

        auth()->login($user);
        $usuario = User::find(Auth::id());
        // Generando código qr
        $qr = QrCode::generate(json_encode(['usuario' => $usuario->email, 'id' => $usuario->id]));
        $html =  base64_encode($qr);

        $data = ['usuario' => $usuario, 'qr' => $html];
        // Generando pdf
        $pdf = PDF::loadView('user.pdf', $data);

        $data["email"] = $usuario->email;
        $data["title"] = "CASINO APP -> CARNET  ";

        Mail::send('emails.welcome', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "CARNET.pdf");
        });


        return redirect()->to('/');
    }
}
