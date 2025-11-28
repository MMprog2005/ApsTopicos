@extends('layouts.app')
@section('content')
<h1>{{ $recipe->title }}</h1>
<p>Categoria: {{ $recipe->category }}</p>
@if($recipe->image_path)
    <img src="{{ asset('storage/'.$recipe->image_path) }}" alt="Imagem" style="max-width:400px;">
@endif
<h3>Ingredientes</h3>
<p>{!! nl2br(e($recipe->ingredients)) !!}</p>

<h3>Instruções</h3>
<p>{!! nl2br(e($recipe->instructions)) !!}</p>

<a href="{{ route('recipes.index') }}">Voltar</a>
@endsection
