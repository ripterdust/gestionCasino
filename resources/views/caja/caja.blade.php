@extends('layouts.app')

@section('title')
    Caja - {{ $cliente->name }}

@endsection

@section('content')
    <script>
        let urlModal = ''
    </script>
    <div class="modal hidden mdl-center" id="modalFactura">
        <div class="text" >
            ¿Imprimir recibo?
        </div>
        <a class="btn" id="enlaceModal" target="_blank">Imprimir</a>
    </div>
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
            <script>
                urlModal = {!! json_encode(route('recibo', ['id' => $message])) !!}
            </script>
            @enderror
        </form>
    </div>
    
    <script>
        const modal = document.querySelector('#modalFactura')
        const a = document.querySelector('#enlaceModal')
        if(urlModal){
                modal.classList.remove('hidden')
                a.href = urlModal
        }

        a.addEventListener('click', () => {
            modal.classList.add('hidden')
        })
    </script>
    
@endsection