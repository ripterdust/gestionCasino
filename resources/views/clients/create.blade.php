@extends('layouts.app')

@section('title')
    Nuevo Cajero
@endsection

@section('content')
    <div class="frm-body">
        <form action="{{ route('cliente.store') }}" method="post">
            @csrf
            @method('post')
            <div class="title"><i class="fa-solid fa-id-card"></i></div>
            <div class="frm">
                <label for="">Nombres</label>
                <input type="text" name="name" required />
            </div>
            <div class="frm">
                <label for="">Apellidos</label>
                <input type="text" name="lname" required />
            </div>
            <div class="frm">
                <label for="">Fecha de nacimiento</label>
                <input type="date" name="birth" required />
            </div>
            <div class="frm">
                <label for="">Correo electrónico</label>
                <input type="email" name="email" requried />
            </div>
            <div class="frm">
                <label for="">Celular</label>
                <input type="text" name="phone" required />        
            </div>
            <div class="frm">
                <label for="">Dirección</label>
                <input type="text" name="adress" required />
            </div>
            <input type="submit" value="Guardar" class="btn btn-fill">
        </form>
    </div>
@endsection

