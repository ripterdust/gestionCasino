@extends('layouts.home')

@section('title')
    Usuario
@endsection


@section('content')
    <div class="modal hidden" id="fotoModal">
        <video class="camara" id="camara" src="" autoplay=true></video>
        <div class="btn btn-fill" id="capturar">Tomar foto</div>
        <canvas id="canvasFoto"></canvas>
    </div>
    <div class="metrics">
        <div class="metric">
            <div class="text">
                <div class="title">Monedas totales</div>
                <div class="subtitle">{{ $cliente->coins }}</div>
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

    <div class="container mt-2">
        <div class="card g-2">
            <div class="text flexbox f-center">
                <div class="nombre">
                    <label for="">Nombre:</label>
                    {{ $cliente->name }}
    
                </div>
                <div class="mail">
                    <label for="">Correo electrónico:</label>
                    {{ $cliente->email }}
                </div>
            </div>
            <div class="photo" id="">
                @if ($cliente->img)
                    <img src="{{ $cliente->img }}" alt="" class="imagen">
                       <div class="overlay" id="tomarFoto">
                            <div class="btn btn-fill" id="nuevaFOto">Tomar nueva foto</div>
                        </div>
                @else
                    <div class="tomarFoto" id="tomarFoto">

                        <div class="btn" id="">Tomar foto</div>
                     
                    </div>                    
                @endif
            </div>
        </div>
        <div class="card mt-2">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Nombre cajero</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>

                @foreach ($transacciones as $trc)
                    <tr>
                        <td>{{ $trc->id }}</td>
                        <td>{{ $trc->name }}</td>

                        @if ($trc->cantidad > 0)
                            <td class="verde">
                                    
                        @else
                            <td class="rojo">
                                    
                        @endif
                            <span>{{ $trc->cantidad }}</span>
                        </td>
                        <td>
                            {{ 
                                date_format(
                                    new DateTime($trc->created_at), 
                                    'H:i d/m/y'
                                )
                             }}
                           </td>
                    </tr>
                @endforeach
            </table>
          
        </div>

    </div>

    <script>
        const URLGuardar = {!! json_encode(route('img')) !!} || ''
        const id = {!! json_encode($id) !!}
    </script>
    
    @vite('resources/js/user/tomarFoto.js')

@endsection