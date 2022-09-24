@extends('layouts.app')

@section('title')
    Caja - {{ $cliente->name }}

@endsection

@section('content')
    <script>
        let data = '';
    </script>

    <div class="frm-body">
       
        <form action="{{ route('monedas.store') }}" method="POST">
            @csrf
            @method('post')
     
            <div class="title"><i class="fa-solid fa-coins"></i></div>
            <input type="hidden" name="id" value="{{ $cliente->id }}">
            <label for="">Cantidad total | {{ $cliente->coins }} monedas</label>
            @error('message')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
            @error('coins')
                <div class="error">
                    Cantidad no válida
                </div>
            @enderror
            @error('scs')
                <div class="ok">{{ $message }}</div>

            @enderror
           
            <div class="frm">
                
                <label for="">Transaccion</label>
                <input type="text" value="0" name="coins">
            </div>

            <input type="submit" value="Guardar" class="btn btn-fill">


            @error('pdf')
            <a href="{{ route('recibo', ['id' => $message]) }}" target="_blank" class="btn btn-fill recibo">Imprimir recibo</a>
            @enderror
        </form>
    </div>
    
    <script>
       
    </script>
    
@endsection