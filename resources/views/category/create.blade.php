@extends('layouts.app')
@section('title', 'Crear Categoria')
@section('content')
<div class="max-w-3xl mx-auto py-6">

    <div class="bg-brand-green border-[3px] border-brand-dark rounded-[20px] p-6 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-white/15 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-brand-dark [text-shadow:2px_2px_0_rgba(255,255,255,0.3)]">🏷️ Crear Categoría</h1>
            <p class="font-bold text-sm text-brand-dark/80 mt-1">Organiza tus libros con nuevas categorías</p>
        </div>
        <span class="text-6xl">✨</span>
    </div>

    <form action="{{ route('categories.store') }}" method="POST"
        class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo p-7 space-y-5">
        @csrf
        @include('category._form', compact('category'))
        <div class="flex gap-3 pt-3 border-t-2 border-dashed border-gray-200">
            <button type="submit"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                💾 Guardar Categoría
            </button>
            <a href="{{ route('books.index') }}"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-white text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✖️ Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
