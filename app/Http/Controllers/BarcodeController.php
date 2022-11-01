<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{

    public function show($id)
    {

        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->back();
        }
        return view('Barcode', ['cliente' => $cliente]);
    }
}
