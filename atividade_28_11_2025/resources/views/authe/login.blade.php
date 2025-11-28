@extends('layouts.app')
@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label>Email</label>
    <input name="email" value="{{ old('email') }}">
    @error('email') <div>{{ $message }}</div> @enderror

    <label>Senha</label>
    <input type="password" name="password">
    @error('password') <div>{{ $message }}</div> @enderror

    <button type="submit">Entrar</button>
</form>
@endsection
