@extends('layouts.app')

@section('title', 'Catálogo de Libros')

@section('content')

{{-- ===== Welcome banner ===== --}}
<section
    class="bg-brand-blue border-[3px] border-brand-dark rounded-[20px] p-7 mb-7 flex items-center justify-between shadow-neo relative overflow-hidden">
    <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-white/15 rounded-full pointer-events-none"></div>
    <div class="absolute right-20 top-4 w-12 h-12 bg-white/10 rounded-full pointer-events-none"></div>

    <div class="relative">
        @auth
        <h1 class="font-fredoka text-3xl md:text-4xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">
            ¡Hola, {{ Auth::user()->name }}! 👋
        </h1>
        @endauth
        @guest
        <h1 class="font-fredoka text-3xl md:text-4xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">
            ¡Hola, Maravilloso Lector! 👋
        </h1>
        @endguest
        <p class="text-white/90 font-bold text-sm md:text-base mt-2">
            Explora nuestro catálogo y encuentra tu próxima aventura.
        </p>
    </div>
    <span class="text-6xl md:text-7xl relative">🦉</span>
</section>

{{-- ===== Header del catálogo ===== --}}
<header class="flex flex-wrap items-end justify-between gap-3 mb-6">
    <div>
        <h2 class="font-fredoka text-2xl md:text-3xl text-brand-dark flex items-center gap-2">
            📚 Catálogo de Libros
        </h2>
        <p class="font-extrabold text-xs text-brand-dark/60 mt-1 uppercase tracking-wider">
            Todos los títulos disponibles
        </p>
    </div>

    <span
        class="font-fredoka text-sm px-4 py-1.5 bg-brand-yellow border-[2.5px] border-brand-dark rounded-full shadow-neo-sm">
        {{ $books->total() }} libros
    </span>
</header>

{{-- ===== Grid de libros ===== --}}
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($books as $book)
    <x-book-card :book="$book" />
    @endforeach
</section>

{{-- ===== Paginación ===== --}}
<div class="mt-10">
    {{ $books->links() }}
</div>
@endsection
