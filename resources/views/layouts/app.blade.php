<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     @vite(['resources/js/app.js', 'resources/sass/common/index.scss'])
    <title>@yield('title')</title>
</head>
<body>
    <nav>
        <div class="logo">Nombre del casino</div>

        <a href="{{ route('logout') }}" class="btn btn-fill">Cerrar sesión</a>
    </nav>
    @yield('content')
</body>
</html>