@extends('app')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{$category->name}}</h1>
<div class="mb-6">
    <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">← Volver a categorias</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($books as $book)
    <x-book-card :book="$book" />
    @endforeach
</div>

@endsection