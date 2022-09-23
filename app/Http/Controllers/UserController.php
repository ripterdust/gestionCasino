<?php

namespace App\Http\Controllers;

use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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

        if ($usuario->role != 'admin') return redirect()->route('monedas');

        $usuarios = DB::table('users')
            ->where('role', '!=', 'admin')
            ->where('show', '!=', False)
            ->get();
        return view('admin.index', compact('usuario', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();

        $usuario = User::find($id);

        if ($usuario->role != 'admin') return redirect()->route('monedas');

        return view('admin.create', compact('usuario'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = 'cajero';
        $usuario->password = $request->password;
        $usuario->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role != 'admin') return redirect()->back();
        $usuario = User::find($id);

        $transacciones = DB::table('transacciones')
            ->select('transacciones.created_at', 'clientes.name', 'cantidad', 'transacciones.id')
            ->leftJoin('clientes', 'clientes.id', '=', 'cliente_id')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(100);

        return view('admin.show', compact('usuario', 'transacciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find(Auth::id());
        $cajero = User::find((int)$id);
        return view('admin.edit', compact('cajero', 'usuario'));
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

        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
            'name' => 'required|min:5|max:200'
        ]);
        $cliente = User::find((int)$id);
        $cliente->name = $request->name;
        $cliente->email = $request->email;
        $cliente->password = $cliente->password;
        $cliente->save();
        return redirect()->back()->withErrors(['success' => 'Datos actualizados correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find((int)$id);
        $usuario->show = False;
        $usuario->save();
        return redirect()->back();
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

        if ($usuario != null && $usuario->email == $email) {
            Auth::loginUsingId($id, true);
        }
        return redirect()->route('index');
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
}
