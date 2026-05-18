@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    {{-- Welcome banner --}}
    <div class="bg-brand-purple border-[3px] border-brand-dark rounded-[20px] p-7 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden"
        @if(!empty($category->color)) style="background-color: {{ $category->color }};" @endif>
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="absolute -left-8 -top-8 w-24 h-24 bg-white/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">🏷️ {{$category->name}}</h1>
            @if($category->description)
            <p class="text-white/90 font-bold text-sm mt-1">{{ $category->description }}</p>
            @endif
        </div>
        <span class="text-7xl">📚</span>
    </div>

    <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
        <a href="{{ route('categories.index') }}" class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo inline-flex items-center gap-1">
            ← Volver a categorías
        </a>
        @auth
            @if(Auth::user()->hasRole('librarian'))
            <a href="{{ route('categories.edit', $category) }}"
            class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✏️ Editar Categoría
            </a>
            @endif
        @endauth
    </div>

    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">
        <div class="bg-brand-orange px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            📖 Libros en esta categoría
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
            <x-book-card :book="$book" />
            @endforeach
        </div>
    </div>
</div>

@endsection
