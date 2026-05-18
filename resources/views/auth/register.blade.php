@extends('layouts.app')
@section('title', 'Crear cuenta')
@section('content')
<div class="max-w-md mx-auto mt-10 relative">

    {{-- Elementos decorativos de fondo --}}
    <div class="absolute -top-6 -left-8 text-5xl opacity-70 rotate-[-15deg] pointer-events-none">✨</div>
    <div class="absolute -top-4 -right-6 text-4xl opacity-70 rotate-[12deg] pointer-events-none">📖</div>

    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-pink px-6 py-5 border-b-[2.5px] border-brand-dark flex items-center gap-3 relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-20 h-20 bg-white/15 rounded-full"></div>
            <span class="text-3xl">🎉</span>
            <h1 class="font-fredoka text-2xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">Crear cuenta</h1>
        </div>

        <div class="p-7">
            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf
                {{-- Nombre --}}
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">😊 Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-[2.5px] @error('name') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                    @error('name')
                    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
                {{-- Email --}}
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📧 Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border-[2.5px] @error('email') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                    @error('email')
                    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
                {{-- Contraseña --}}
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🔑 Contraseña</label>
                    <input type="password" name="password"
                        class="w-full border-[2.5px] @error('password') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                    @error('password')
                    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
                {{-- Confirmar contraseña --}}
                <div>
                    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🔒 Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
                </div>
                <button type="submit"
                    class="w-full font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    🎊 Crear cuenta
                </button>
            </form>
            <p class="text-center text-sm font-bold text-brand-dark mt-5">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-fredoka text-brand-orange hover:text-brand-pink underline decoration-2 underline-offset-2">Inicia sesión 🚀</a>
            </p>
        </div>
    </div>
</div>
@endsection
