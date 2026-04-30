@extends('app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Categorias</h1>

<div class="mb-6">
    <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">← Volver a libros</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($categories as $category)
    <x-category-card :category="$category" />
    @endforeach
</div>
@endsection