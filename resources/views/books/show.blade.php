@extends('layouts.app')
@section('title', $book->title)
@section('content')
<a href="{{ route('books.index') }}"
    class="text-sm text-slate-600 hover:text-slate-900 mb-4 inline-block">
    ← Volver al catálogo
</a>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- ===== Columna izquierda: portada ===== --}}
    <div class="lg:col-span-1">
        @if($book->cover_url)
        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
            class="w-full rounded shadow-md">
        @else
        <div class="w-full aspect-[2/3] bg-slate-200 rounded flex
items-center
 justify-center text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20"
                fill="none"
                viewBox="0 0 24 24" stroke="currentColor" strokewidth="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
 S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18
7.5 18" />
            </svg>
        </div>
        @endif
    </div>
    {{-- ===== Columna derecha: información ===== --}}
    <div class="lg:col-span-2 space-y-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">{{ $book->title }}</h1>
            <p class="text-slate-600 mt-1">
                @foreach($book->authors as $author)
                <a href="{{ route('authors.show', $author) }}"
                    class="hover:underline">{{ $author->full_name }}</a>@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
        <div class="flex gap-2 items-center">
            <x-category-badge :category="$book->category" />
            <x-book-status-badge :status="$book->status" />
        </div>
        <dl class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
            <dt class="text-slate-500">ISBN</dt>
            <dd>{{ $book->isbn ?? '—' }}</dd>
            <dt class="text-slate-500">Editorial</dt>
            <dd>{{ $book->publisher ?? '—' }}</dd>
            <dt class="text-slate-500">Año de publicación</dt>
            <dd>{{ $book->publication_year ?? '—' }}</dd>
            <dt class="text-slate-500">Páginas</dt>
            <dd>{{ $book->pages ?? '—' }}</dd>
            <dt class="text-slate-500">Idioma</dt>
            <dd>{{ $book->language ?? '—' }}</dd>
        </dl>
        @if($book->description)
        <div class="pt-2">
            <h2 class="font-semibold text-slate-900 mb1">Descripción</h2>
            <p class="text-slate-700 leading-relaxed">{{ $book->description }}</p>
        </div>
        @endif
        {{-- ===== Disponibilidad ===== --}}
        <div class="bg-slate-100 rounded p-4">
            <h2 class="font-semibold text-slate-900 mb1">Disponibilidad</h2>
            <p class="text-slate-700">
                <span class="text-2xl font-bold text-slate-900">
                    {{ $book->available_copies }}
                </span>
                de {{ $book->total_copies }} copias disponibles
            </p>
        </div>
        {{-- Dentro de books/show.blade.php, después del bloque de disponibilidad --}}
        <div class="flex gap-3 pt-4">
            <a href="{{ route('books.edit', $book) }}"
                class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded text-sm">
                Editar libro
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="border border-red-300 text-red-600 hover:bg-red-50 px-4 py-2 rounded text-sm"
                    onclick="return confirm('¿Eliminar este libro?')">
                    Eliminar
                </button>
            </form>
        </div>

        {{-- ===== Préstamos activos ===== --}}
        @if($book->activeLoans->isNotEmpty())
        <div class="pt-2">
            <h2 class="font-semibold text-slate-900 mb-2">Préstamos
                activos</h2>
            <table class="w-full text-sm">
                <thead class="bg-slate-200 text-slate-700">
                    <tr>
                        <th class="text-left px-3 py-2">Miembro</th>
                        <th class="text-left px-3 py-2">Fecha
                            préstamo</th>
                        <th class="text-left px-3 py-2">Devolución</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book->activeLoans as $loan)
                    <tr class="border-b border-slate-200">
                        <td class="px-3 py-2">
                            {{ $loan->member->user->name ?? '—' }}
                        </td>
                        <td class="px-3 py-2">
                            {{ $loan->loaned_at?->format('d/m/Y') }}
                        </td>
                        <td class="px-3 py-2">
                            {{ $loan->due_at?->format('d/m/Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection