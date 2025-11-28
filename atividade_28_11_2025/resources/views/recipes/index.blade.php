@extends('layouts.app')

@section('content')
<h1>Receitas</h1>

<form method="GET" action="{{ route('recipes.index') }}">
    <input type="text" name="category" placeholder="Filtrar por categoria" value="{{ request('category') }}">
    <button type="submit">Filtrar</button>
</form>

{{-- mostrar cookie de última categoria --}}
@if(request()->cookie('last_category'))
    <p>Última categoria visitada: {{ request()->cookie('last_category') }}</p>
@endif

@if(session('user_id'))
    <a href="{{ route('recipes.create') }}">Nova Receita</a>
@endif

<ul>
@foreach($recipes as $r)
    <li>
        <a href="{{ route('recipes.show', $r) }}">{{ $r->title }}</a>
        @if($r->image_path)
            <img src="{{ asset('storage/'.$r->image_path) }}" alt="Imagem" style="height:60px;">
        @endif
        @if(session('user_id'))
            <a href="{{ route('recipes.edit', $r) }}">Editar</a>
            <form method="POST" action="{{ route('recipes.destroy', $r) }}" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Excluir?')">Excluir</button>
            </form>
        @endif
    </li>
@endforeach
</ul>

{{ $recipes->links() }}
@endsection
