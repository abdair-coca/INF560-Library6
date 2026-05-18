@extends('layouts.app')

@section('title', 'Autores')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    {{-- Welcome Banner --}}
    <div class="bg-brand-purple border-[3px] border-brand-dark rounded-[20px] p-7 mb-7 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="absolute -left-8 -top-8 w-24 h-24 bg-white/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">✏️ Autores</h1>
            <p class="text-white/90 font-bold text-sm mt-1">Descubre las mentes detrás de cada gran historia</p>
        </div>
        @role('admin')
        <a href="{{ route('authors.create') }}" class="font-fredoka text-base px-6 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo flex items-center gap-2 shrink-0">
            ✨ Añadir Autor
        </a>
        @endrole
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($authors as $author)
            @php
                $colors = ['bg-brand-yellow', 'bg-brand-pink', 'bg-brand-blue', 'bg-brand-purple text-white', 'bg-brand-orange text-white', 'bg-brand-green'];
                $bgClass = $colors[$loop->index % 6];
            @endphp
            <article class="{{ $bgClass }} border-[3px] border-brand-dark rounded-[20px] shadow-neo p-6 transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover relative overflow-hidden">
                <span class="absolute right-3 bottom-2 text-7xl opacity-20 leading-none pointer-events-none">✏️</span>

                <div class="w-14 h-14 rounded-full border-[2.5px] border-brand-dark bg-white flex items-center justify-center text-2xl shadow-neo-sm mb-3">
                    ✏️
                </div>

                <h2 class="font-fredoka text-2xl leading-tight">{{ $author->full_name }}</h2>
                <p class="font-extrabold text-sm opacity-80 mt-1 flex items-center gap-1">🌎 {{ $author->nationality }}</p>
                @if($author->birth_date)
                    <p class="text-xs font-bold opacity-70 mt-1">📅 Nacido: {{ $author->birth_date->format('d/m/Y') }}</p>
                @endif
                <div class="mt-4 flex gap-2 flex-wrap relative z-10">
                    <a href="{{ route('authors.show', $author->id) }}" class="font-nunito font-extrabold text-xs px-3 py-1.5 rounded-full border-2 border-brand-dark bg-white text-brand-dark shadow-neo-sm transition-all hover:-translate-x-0.5 hover:-translate-y-0.5">
                        👁️ Ver
                    </a>
                    @role('admin')
                    <a href="{{ route('authors.edit', $author->id) }}" class="font-nunito font-extrabold text-xs px-3 py-1.5 rounded-full border-2 border-brand-dark bg-brand-dark text-white shadow-neo-sm transition-all hover:-translate-x-0.5 hover:-translate-y-0.5">
                        ✏️ Editar
                    </a>
                    @endrole
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        {{ $authors->links() }}
    </div>
</div>
@endsection
