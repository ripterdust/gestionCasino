@extends('layouts.app')

@section('title')
    Usuario
@endsection


@section('content')

  <div class="button">
        <a href="{{ route('cliente.new') }}" class="btn btn-fill">Agregar nuevo Cliente</a>
    </div>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Celular</th>
            <th>Monedas</th>
            <th>Accion</th>
        </tr>

        @foreach ($clientes as $cliente)
            <tr>
                <td><a href="">{{  $cliente->name }}</a></td>
                <td>{{ $cliente->phone }}</td>
                <td>{{ $cliente->coins }}</td>
                <td>
                    <a href="" class="acn"><i class="fa-solid fa-pen"></i></a>
                    <a href="" class="acn"><i class="fa-solid fa-trash"></i></a>
                    <a href="" class="acn"><i class="fa-solid fa-id-badge"></i></a>
                </td>
            </tr>
        @endforeach


    </table>
@endsection