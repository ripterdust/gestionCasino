<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     @vite(['resources/js/app.js', 'resources/sass/common/index.scss', 'resources/sass/admin/index.scss'])
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>@yield('title')</title>
</head>
<body>
    
    <aside>
        <div class="logo">
            Logo del casino
        </div>
      
        @if ($usuario->role == 'admin')
            <div class="option">
                <div class="icono">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <a href="/cajero" class="">Cajeros</a>
            </div>
            <div class="option">
                <div class="icono">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <a href="/carnet" class="">Usarios</a>
            </div>
        @else
            <div class="option">
                <div class="icono">
                    <i class="fa-solid fa-house"></i>
                </div>
                <a href="/" class="">Inicio</a>
            </div>
        @endif
    </aside>
    <div class="content">
        <div class="header">
            <a href="{{ route('logout') }}" class="btn btn-fill">Salir</a>
        </div>
        <div class="container">
            @yield('content')   
        </div>
    </div>
</body>
</html>