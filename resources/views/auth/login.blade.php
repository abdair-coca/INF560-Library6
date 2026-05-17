@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Iniciar sesión</h1>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="mt-1 w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Contraseña</label>
            <input type="password" name="password"
                class="mt-1 w-full border rounded-lg px-3 py-2">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="rounded">
            <label for="remember" class="text-sm text-slate-600">Recordarme</label>
        </div>
        <button type="submit"
            class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg">
            Iniciar sesión
        </button>
    </form>
    <p class="text-center text-sm text-slate-600 mt-4">
        ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-amber-600
hover:underline">Regístrate</a>
    </p>
</div>
@endsection