@extends('app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">← Volver a libros</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $book->title }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600"><strong>Imprenta:</strong> {{ $book->publisher }}</p>
            </div>
            @if($book->publish_year)
            <div>
                <p class="text-gray-600"><strong>Año de publicación:</strong> {{ $book->publish_year }}</p>
            </div>
            @endif
            <div>
                <p class="text-gray-600"><strong>Lenguaje:</strong> {{ $book->language}}</p>
            </div>
            <div>
                <p class="text-gray-600"><strong>Paginas:</strong> {{ $book->pages}}</p>
            </div>
        </div>

        @if($book->description)
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Descripción</h2>
            <p class="text-gray-700">{{ $book->description }}</p>
        </div>
        @endif

        <div class="flex gap-4">
            <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este autor?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
            </form>
        </div>
    </div>

    @if($book->authors->count() > 0)
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Autores</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($book->authors as $author)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold text-gray-800">{{ $author->full_name }}</h3>
                    <a href="{{ route('authors.show', $author->id) }}" class="text-blue-600 hover:underline text-sm">Ver autor</a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection