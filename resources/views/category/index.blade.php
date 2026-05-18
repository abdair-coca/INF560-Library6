@extends('layouts.app')

@section('title', 'Categorías')

@section('content')

{{-- ===== Header ===== --}}
<section
    class="bg-brand-purple border-[3px] border-brand-dark rounded-[20px] p-7 mb-7 flex items-center justify-between shadow-neo relative overflow-hidden text-white">
    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/15 rounded-full pointer-events-none"></div>
    <div class="absolute right-24 top-3 w-10 h-10 bg-white/10 rounded-full pointer-events-none"></div>

    <div class="relative">
        <h1 class="font-fredoka text-3xl md:text-4xl [text-shadow:2px_2px_0_rgba(0,0,0,0.2)] flex items-center gap-2">
            🏷️ Categorías
        </h1>
        <p class="text-white/90 font-bold text-sm md:text-base mt-2">
            Explora todos los géneros disponibles en la biblioteca.
        </p>
    </div>
    <span class="text-6xl md:text-7xl relative">🗂️</span>
</section>

{{-- ===== Volver ===== --}}
<a href="{{ route('books.index') }}"
    class="inline-flex items-center gap-1.5 font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo mb-6">
    ← Volver a libros
</a>

{{-- ===== Grid de categorías ===== --}}
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($categories as $category)
    <x-category-card :category="$category" />
    @endforeach
</section>

@endsection
