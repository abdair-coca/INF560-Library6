@extends('app')

@section('title', 'Autores')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Autores</h1>
    <a href="{{ route('authors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Añadir Autor</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($authors as $author)
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800">{{ $author->full_name }}</h2>
            <p class="text-gray-600 mt-2">{{ $author->nationality }}</p>
            @if($author->birth_date)
                <p class="text-sm text-gray-500 mt-1">Nacido: {{ $author->birth_date->format('d/m/Y') }}</p>
            @endif
            <div class="mt-4 flex gap-2">
                <a href="{{ route('authors.show', $author->id) }}" class="text-blue-600 hover:underline">Ver</a>
                <a href="{{ route('authors.edit', $author->id) }}" class="text-yellow-600 hover:underline">Editar</a>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $authors->links() }}
</div>
@endsection