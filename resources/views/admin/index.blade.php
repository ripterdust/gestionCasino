@extends('layouts.app')

@section('title')
 CASINO APP - {{ $usuario->name }}
@endsection

@section('content')
    <div class="button">
        <a href="" class="btn btn-fill">Agregar nuevo cajero</a>
    </div>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Accion</th>
        </tr>

        @foreach ($usuarios as $usr)
            <tr>
                <td><a href="">{{  $usr->name }}</a></td>
                <td>{{ $usr->email }}</td>
                <td>
                    <a href="" class="acn"><i class="fa-solid fa-pen"></i></a>
                    <a href="" class="acn"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        @endforeach


    </table>
    
@endsection