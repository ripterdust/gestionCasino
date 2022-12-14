<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon.ico') }}">
    {{-- @vite(['resources/js/app.js', 'resources/sass/index.scss']) --}}

    <title>@yield('title')</title>
</head>
<body class="body">
    @yield('content')
    <script>
        localStorage.setItem('animacion', JSON.stringify({enable: true}))
    </script>
</body>

</html>