@extends('layouts.app')
@section('title', 'Crear cuenta')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white rounded-xl shadow p-8">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Crear cuenta</h1>
    <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
        @csrf
        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Nombre completo</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="mt-1 w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="mt-1 w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Contraseña --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Contraseña</label>
            <input type="password" name="password"
                class="mt-1 w-full border rounded-lg px-3 py-2 @error('password') border-red-500 @enderror">
            @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Confirmar contraseña --}}
        <div>
            <label class="block text-sm font-medium text-slate-700">Confirmar contraseña</label>
            <input type="password" name="password_confirmation"
                class="mt-1 w-full border rounded-lg px-3 py-2">
        </div>
        <button type="submit"
            class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg">
            Crear cuenta
        </button>
    </form>
    <p class="text-center text-sm text-slate-600 mt-4">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-amber-600
hover:underline">Inicia sesión</a>
    </p>
</div>
@endsection