@extends('layouts.app')

@section('title')
    Caja - {{ $cliente->name }}

@endsection

@section('content')
  

    <div class="frm-body">
       
        <form action="{{ route('monedas.store') }}" method="POST">
            @csrf
            @method('post')
         
            <div class="title"><i class="fa-solid fa-coins"></i></div>
            <input type="hidden" name="id" value="{{ $cliente->id }}">
            <label for="">Cantidad total - {{ $cliente->coins }}</label>
            @error('message')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
            <div class="frm">
                
                <label for="">Transaccion</label>
                <input type="text" value="0" name="coins">
            </div>

            <input type="submit" value="Guardar" class="btn btn-fill">
        </form>
    </div>
@endsection