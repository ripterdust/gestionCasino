@extends('layouts.app')

@section('title')
    Usuario
@endsection


@section('content')
    <div class="modal hidden" id="fotoModal">
        <input type="file" name="" id="archivoImagen">
        <video class="camara" id="camara" src="" autoplay=true></video>
        <div class="btn btn-fill" id="capturar">Tomar foto</div>
        <canvas id="canvasFoto"></canvas>
    </div>
    <div class="metrics">
        <div class="metric">
            <div class="text">
                <div class="title">Monedas totales</div>
                <div class="subtitle">{{ $usuario->coins }}</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-coins"></i>
            </div>
        </div>
        <div></div>
        <div></div>
        <div class="metric">
            <div class="text">
                <div class="title">Registrado desde</div>
                <div class="subtitle">            
                    {{ $fecha }}
                </div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>

    <div class="container g-2 mt-2">
        <div class="card g-2">
            <div class="text">
                <div class="nombre">
                    {{ $usuario->name }}
    
                </div>
                <div>
                    {{ $usuario->email }}
                </div>
            </div>
            <div class="photo">
                @if ($usuario->img)
                    <img src="{{ $usuario->img }}" alt="">
                @else
                    <div class="tomarFoto" id="tomarFoto">

                        <div class="btn" id="">Tomar foto</div>
                    </div>                    
                @endif
            </div>
        </div>
        <div class="card">Tarjeta dos</div>
    </div>

    <script>
        const URLGuardar = {!! json_encode(route('img')) !!} || ''
        const id = {!! json_encode($id) !!}
    </script>
    
    @vite('resources/js/user/tomarFoto.js')

@endsection