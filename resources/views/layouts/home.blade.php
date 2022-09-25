<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @vite(['resources/js/app.js', 'resources/sass/common/index.scss'])
    <title>@yield('title')</title>
</head> 
<body>
    <nav>
        <div class="logo">
            Acá irá el logo
        </div>

        @if ($usuario)
            <a href="{{ route('index') }}" class="btn btn-fill">Cerrar</a>
        @endif
    </nav>
    <div class="container-body">
        @yield('content')
    </div>
</body>
</html>