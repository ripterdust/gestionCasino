<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
       <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    {{-- @vite(['resources/js/app.js', 'resources/sass/index.scss']) --}}

    <title>@yield('title')</title>
</head>
<body class=" animate__animated animate__fadeIn">
    
    <aside>
        <div class="logo">
            Golden room
        </div>
      
        @if ($usuario->role == 'admin')
            <a href="{{ route('home') }}" class="option">
                <div class="icono">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <span href="{{ route('home') }}" class="">Cajeros</span>
            </a>
            <a href="{{ route('clientes') }}" class="option">
                <div class="icono">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <span href="{{ route('clientes') }}" class="">Clientes</span>
            </a>
        @else
            <a href="{{ route('home') }}" class="option">
                
                <div class="icono">
                    <i class="fa-solid fa-house"></i>
                </div>
                <span href="{{ route('home') }}" class="">Inicio</span>
            </a>
        @endif
        
        <a class="option logout" href="{{ route('logout') }}">
            <div class="icono">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </a>
    </aside>
    <div class="content">
        <div class="header">
            <a href="{{ route('logout') }}" class="btn btn-fill">Salir</a>
        </div>
        <div class="container">
            @yield('content')   
        </div>
    </div>
    <div class="animacion">
        <img src="{{ asset('img/logo.jpeg') }}" alt="">
        Bienvenido
    </div>
    <script>
        const path = window.location.href;
        const options = document.querySelectorAll('.option');
        options.forEach(option => {
            if(option.href == path) option.classList.add('active')
        })

        const stg = JSON.parse(localStorage.getItem('animacion'))
        if(stg.enable) {
            const an = document.querySelector('.animacion')
            an.classList.add('animacion-activa')
            localStorage.setItem('animacion', JSON.stringify({enable: false}))
        }
    </script>
    
</body>
</html>