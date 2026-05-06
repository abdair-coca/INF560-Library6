RESOURCES/VIEWS/BOOKS/EDIT.BLADE.PHP
@extends('layouts.app')
@section('title', 'Editar: ' . $book->title)
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">
        Editar: {{ $book->title }}
    </h1>
    <form action="{{ route('books.update', $book) }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')
        @include('books._form', ['selectedAuthors' => $selectedAuthors])
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded">
                Actualizar libro
            </button>
            <a href="{{ route('books.show', $book) }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">
                Cancelar
            </a>
            {{-- Eliminar --}}
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="mlauto">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-600 hover:text-red-800 text-sm"
                    onclick="return confirm('¿Eliminar este libro permanentemente?')">
                    Eliminar libro
                </button>
            </form>
        </div>
    </form>
</div>
@endsection