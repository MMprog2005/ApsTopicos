@extends('layouts.app')
@section('content')
<h2>Nova Receita</h2>
<form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Título</label>
    <input name="title" value="{{ old('title') }}">
    @error('title') <div>{{ $message }}</div> @enderror

    <label>Ingredientes</label>
    <textarea name="ingredients">{{ old('ingredients') }}</textarea>
    @error('ingredients') <div>{{ $message }}</div> @enderror

    <label>Instruções</label>
    <textarea name="instructions">{{ old('instructions') }}</textarea>
    @error('instructions') <div>{{ $message }}</div> @enderror

    <label>Categoria</label>
    <input name="category" value="{{ old('category') }}">

    <label>Tempo (min)</label>
    <input name="prep_time" type="number" value="{{ old('prep_time') }}">

    <label>Imagem (PNG/JPG)</label>
    <input type="file" name="image">
    @error('image') <div>{{ $message }}</div> @enderror

    <button type="submit">Salvar</button>
</form>
@endsection
