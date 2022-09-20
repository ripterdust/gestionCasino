<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
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
        if ($usuario->role != 'admin') return redirect()->route('monedas', 'clientes');

        $clientes = Cliente::get();

        return view('clients.table', compact('usuario', 'clientes'));
    }

    public function mostrarUsuario($id)
    {
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
        $id = Auth::id();

        $usuario = User::find($id);
        if ($usuario->role != 'admin') return redirect()->route('monedas', 'clientes');

        return view('clients.create', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->name = $request->name;
        $cliente->email = $request->email;
        $cliente->phone = $request->phone;
        $cliente->save();

        return redirect()->route('clientes');
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

    public function carnet($id)
    {
        $cliente = Cliente::find($id);

        // Generando código qr
        $datosQr = base64_encode(json_encode(['usuario' => $cliente->email, 'id' => $cliente->id]));
        $qr = QrCode::generate($datosQr);
        $html =  base64_encode($qr);
        $data = ['usuario' => $cliente, 'qr' => $html];
        // Generando pdf
        $pdf = PDF::loadView('clients.pdf', $data);

        return $pdf->stream();
    }

    // Monedas
    public function monedas()
    {
        $id = Auth::id();

        $usuario = User::find($id);
        if ($usuario->role != 'cajero') return redirect()->route('home');

        return view('caja.monedas', compact('usuario'));
    }

    public function agregarMonedas($usuario, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente || $cliente->email != $usuario) return 'No hay nada';

        return $cliente;
    }
}
