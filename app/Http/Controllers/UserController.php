<?php

namespace App\Http\Controllers;

use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();

        $usuario = User::find($id);

        $fecha = $usuario->created_at;
        $fecha = explode(' ', $fecha)[0];
        $fecha = explode('-', $fecha);
        $fecha = join('/', array_reverse($fecha, false));

        return view('user.index', ['usuario' => $usuario, 'fecha' => $fecha, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function saveImage(Request $request)
    {

        $img = $request->input('img');
        $id = $request->input('id');
        $id = intval($id);

        $usuario = User::find($id);
        $usuario->img = $img;
        $usuario->save();

        return ['done' => true, 'img' => $img, 'id' => $id];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // Creación de carnet
    public function carnet()
    {
        $usuario = User::find(Auth::id());

        // Generando código qr
        $datosQr = base64_encode(json_encode(['usuario' => $usuario->email, 'id' => $usuario->id]));
        $qr = QrCode::generate($datosQr);
        $html =  base64_encode($qr);

        $data = ['usuario' => $usuario, 'qr' => $html];
        // Generando pdf
        $pdf = PDF::loadView('user.pdf', $data);

        $data["email"] = $usuario->email;
        $data["title"] = "CASINO APP -> CARNET  ";

        Mail::send('emails.carnet', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "CARNET.pdf");
        });

        return redirect()->route('home');
    }

    public function lecturaQr($email, $id)
    {
        $usuario = User::find($id);

        if ($usuario != null) {
            Auth::loginUsingId($id, true);
        }
        return redirect()->route('index');
    }
}
