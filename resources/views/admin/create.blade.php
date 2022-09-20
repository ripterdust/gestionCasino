@extends('layouts.app')

@section('title')
    Nuevo Cajero
@endsection

@section('content')
    <div class="frm-body">
        <form action="">
            @csrf
            @method('post')
            <div class="title"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="frm">
                <label for="">Nombre</label>
                <input type="text" name="name" required>
            </div>
            <div class="frm">
                <label for="">Correo electrónico</label>
                <input type="email" name="email" requried>
            </div>
            <div class="frm">
                <label for="">Contraseña</label>
                <input type="password" name="password">        
            </div>

            <input type="submit" value="Guardar" class="btn btn-fill">
        </form>
    </div>
@endsection

