<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
</head>
<body>
    <h1>Cadastro de Categorias</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/categorias" method="POST">
        @csrf
        <input type="text" name="nome" placeholder="Nome da categoria">
        <textarea name="descricao" placeholder="Descrição"></textarea>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Lista de Categorias</h2>
    <ul>
        @foreach($categorias as $categoria)
            <li><b>{{ $categoria->nome }}</b> - {{ $categoria->descricao }}</li>
        @endforeach
    </ul>
</body>
</html>
