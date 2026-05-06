@extends('layouts.app')
@section('title', 'Editar: ' . $author->full_name)
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">
        Editar: {{ $author->full_name }}
    </h1>
    <form action="{{ route('authors.update', $author) }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')
        @include('authors._form')
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded">
                Actualizar autor
            </button>
            <a href="{{ route('authors.show', $author) }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">Cancelar</a>
            @if($author->books_count === 0)
            <form action="{{ route('authors.destroy', $author) }}" method="POST"
                class="ml-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-600 hover:text-red-800 text-sm"
                    onclick="return confirm('¿Eliminar este autor?')">
                    Eliminar autor
                </button>
            </form>
            @endif
        </div>
    </form>
</div>
@endsection