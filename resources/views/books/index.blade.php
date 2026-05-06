@extends('layouts.app')

@section('title', 'Catálogo de Libros')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Catálogo de Libros</h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($books as $book)
    <x-book-card :book="$book" />
    @endforeach
</div>

<div class="mt-8">
    {{ $books->links() }}
</div>
@endsection