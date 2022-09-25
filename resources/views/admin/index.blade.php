@extends('layouts.app')

@section('title')
 CASINO APP - {{ $usuario->name }}
@endsection

@section('content')
    <div class="button">
        <a href="{{ route('nuevoCajero') }}" class="btn btn-fill">Agregar nuevo cajero</a>
    </div>
    <div class="bg-table">

        <table class="table ">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Accion</th>
            </tr>
    
            @foreach ($usuarios as $usr)
                <tr>
                    <td><a href="{{ route('cajero', ['id' => $usr->id]) }}">{{  $usr->name }}</a></td>
                    <td>{{ $usr->email }}</td>
                    <td>
                        <a href="{{ route('cajero.edit', ['id' => $usr->id]) }}" class="acn"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{ route('cajero.destroy', ['id' => $usr->id]) }}" class="acn"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
    
    
        </table>
    </div>
    
@endsection