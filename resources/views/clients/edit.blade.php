@extends('layouts.app')

@section('title')
    Nuevo Cajero
@endsection

@section('content')
    <div class="frm-body">
        <form action="{{ route('cajero.patch', ['id' => $cliente->id]) }}" method="post">
            @csrf
            @method('patch')
            @error('success')
                <div class="ok">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="error">Ingrese datos válidos del email</div>
            @enderror
            @error('password')
                <div class="error">Inserte una contraseña válida</div>
            @enderror
             @error('name')
                <div class="error">Inserte un nombre válido</div>
            @enderror
            <div class="title"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="frm">
                <label for="">Nombre</label>
                <input type="text" name="name" required value="{{ $cliente->name }}">
            </div>
            <div class="frm">
                <label for="">Apellido</label>
                <input type="text" name="lname" required value="{{ $cliente->lname }}">
            </div>
            <div class="frm">
                <label for="">Fecha de nacimiento</label>
                <input type="date" name="birth" required value="{{ $cliente->birth }}">
            </div>
             <div class="frm">
                <label for="">Dirección</label>
                <input type="adress" name="adress" requried value="{{ $cliente->adress }}">
            </div>
            <div class="frm">
                <label for="">Correo electrónico</label>
                <input type="email" name="email" requried value="{{ $cliente->email }}">
            </div>
            
            <div class="frm">
                <label for="">Celular</label>
                <input type="text" name="phone" required value="{{ $cliente->phone }}">
            </div>

            <input type="submit" value="Guardar" class="btn btn-fill">
        </form>
    </div>
@endsection

