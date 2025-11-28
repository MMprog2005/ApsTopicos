<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receitas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav>
    <a href="{{ route('recipes.index') }}">Home</a>
    @if(session('user_name'))
        <span>Olá, {{ session('user_name') }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Sair</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
