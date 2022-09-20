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
        <div class="logo">
            Acá irá el logo
        </div>
        <div class="options">
            <a href="{{ route('login') }}" class="btn mr-1">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-fill">Unirme</a>
        </div>
    </nav>
    @yield('content')
</body>
</html>