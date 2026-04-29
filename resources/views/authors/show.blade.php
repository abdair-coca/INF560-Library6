@extends('app')

@section('title', $author->full_name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('authors.index') }}" class="text-blue-600 hover:underline">← Volver a Autores</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $author->full_name }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600"><strong>Nacionalidad:</strong> {{ $author->nationality }}</p>
            </div>
            @if($author->birth_date)
            <div>
                <p class="text-gray-600"><strong>Fecha de nacimiento:</strong> {{ $author->birth_date->format('d/m/Y') }}</p>
            </div>
            @endif
        </div>

        @if($author->biography)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Biografía</h2>
            <p class="text-gray-700">{{ $author->biography }}</p>
        </div>
        @endif

        <div class="flex gap-4">
            <a href="{{ route('authors.edit', $author->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este autor?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
            </form>
        </div>
    </div>

    @if($author->books->count() > 0)
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Libros del autor</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($author->books as $book)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $book->publish_year }}</p>
                    <a href="{{ route('books.show', $book->id) }}" class="text-blue-600 hover:underline text-sm">Ver libro</a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection