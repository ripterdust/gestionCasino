<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Transacciones;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $clientes = Cliente::where('show', '!=', False)
            ->get();

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
        $cliente->adress = $request->adress;
        $cliente->birth = $request->birth;
        $cliente->lname = $request->lname;
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

        $usuario = False;
        $cliente = Cliente::find($id);

        if ($cliente) $usuario = True;
        $fecha = $cliente->created_at;
        $fecha = explode(' ', $fecha)[0];
        $fecha = explode('-', $fecha);
        $fecha = join('/', array_reverse($fecha, false));
        $transacciones = DB::table('transacciones')
            ->select('transacciones.created_at', 'users.name', 'cantidad', 'transacciones.id')
            ->leftJoin('users', 'users.id', '=', 'cajero_id')
            ->orderBy('created_at', 'desc')
            ->where('cliente_id', '=', $cliente->id)
            ->limit(100)
            ->get();


        return view('clients.index', compact('cliente', 'fecha', 'id', 'transacciones', 'usuario'));
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
        if ($usuario->role != 'admin') return redirect()->back();
        $cliente = Cliente::find((int)$id);
        return view('clients.edit', compact('cliente', 'usuario'));
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
        $cliente = Cliente::find((int)$id);
        $cliente->show = False;
        $cliente->save();
        return redirect()->route('clientes');
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

    public function agregarMonedas(Request $request, $usr, $id)
    {
        $idUsr = Auth::id();

        $usuario = User::find($idUsr);
        if ($usuario->role != 'cajero') return redirect()->route('home');

        $cliente = Cliente::find($id);
        if (!$cliente || $cliente->email != $usr) return redirect()->route('monedas');

        return view('caja.caja', compact('usuario', 'cliente'));
    }

    public function guardarMonedas(Request $request)
    {
        $request->validate([
            "coins" => 'required'
        ]);

        if ((int)$request->coins === 0) return redirect()->back()->withErrors(['message' => 'La cantidad no puede ser 0']);

        $cliente = Cliente::find($request->id);
        $request->coins = (int)$request->coins;

        $transaccion = new Transacciones;
        $transaccion->cliente_id = $cliente->id;
        $transaccion->cajero_id = Auth::id();

        $monedas = $cliente->coins + $request->coins;
        if ($request->coins < 0) {
            if ($cliente->coins + (int)$request->coins < 0) return redirect()->back()->withErrors(['message' => 'Fondos insuficientes']);
        }

        $transaccion->cantidad = $request->coins;
        $cliente->coins = $monedas;

        $cliente->save();
        $transaccion->save();

        return redirect()->back()->withErrors(['scs' => 'Transacción realizada con éxito', 'pdf' => $transaccion->id]);
    }

    public function validarQr($usr, $id)
    {
        $id = (int)$id;
        $cliente = Cliente::find($id);

        if (!$cliente || $cliente->email != $usr) return redirect()->back()->withErrors(['message' => 'Usuario inválido o no encontrado']);

        return redirect()->route('cliente.show', ['id' => $cliente->id]);
    }

    public function saveImage(Request $request)
    {

        $img = $request->input('img');
        $id = (int)$request->input('id');

        $cliente = Cliente::find($id);
        $cliente->img = $img;
        $cliente->save();

        return ['done' => true, 'img' => $img, 'id' => $id];
    }

    public function showTransacciones($id)
    {
        $usuario = User::find(Auth::id());
        $transacciones = DB::table('transacciones')
            ->select('transacciones.created_at', 'users.name', 'cantidad', 'transacciones.id')
            ->leftJoin('users', 'users.id', '=', 'cajero_id')
            ->orderBy('created_at', 'desc')
            ->where('cliente_id', '=', $id)
            ->limit(100)
            ->get();

        return view('clients.show', compact('transacciones', 'usuario'));
    }
}
