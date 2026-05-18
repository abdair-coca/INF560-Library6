@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="max-w-md mx-auto mt-10 relative">

    {{-- Elementos decorativos de fondo --}}
    <div class="absolute -top-6 -left-8 text-5xl opacity-70 rotate-[-15deg] pointer-events-none">📚</div>
    <div class="absolute -top-4 -right-6 text-4xl opacity-70 rotate-[12deg] pointer-events-none">🦉</div>

    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-orange px-6 py-5 border-b-[2.5px] border-brand-dark flex items-center gap-3 relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-20 h-20 bg-white/15 rounded-full"></div>
            <span class="text-3xl">🔐</span>
            <h1 class="font-fredoka text-2xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">Iniciar sesión</h1>
        </div>

        <div class="p-7">
            @if(session('success'))
            <div class="bg-brand-green border-[2.5px] border-brand-dark rounded-2xl px-4 py-3 mb-4 font-extrabold text-brand-dark shadow-neo-sm flex items-center gap-2">
                <span class="text-xl">✅</span>
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📧 Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border-[2.5px] @error('email') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                    @error('email')
                    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🔑 Contraseña</label>
                    <input type="password" name="password"
                        class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                </div>
                <div class="flex items-center gap-2 bg-brand-yellow/40 border-2 border-brand-dark rounded-full px-4 py-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-brand-orange">
                    <label for="remember" class="text-sm font-extrabold text-brand-dark">💾 Recordarme</label>
                </div>
                <button type="submit"
                    class="w-full font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    🚀 Iniciar sesión
                </button>
            </form>
            <p class="text-center text-sm font-bold text-brand-dark mt-5">
                ¿No tienes cuenta? <a href="{{ route('register') }}" class="font-fredoka text-brand-orange hover:text-brand-pink underline decoration-2 underline-offset-2">Regístrate ✨</a>
            </p>
        </div>
    </div>
</div>
@endsection
