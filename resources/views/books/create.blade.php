@extends('app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear libro</h1>

<form action="{{ route('books.store') }}" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-md space-y-4">
    @csrf
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Crear Libro</h2>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
        <input type="text" name="title" placeholder="Ej: El Principito"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
        <input type="text" name="isbn" placeholder="Ej: 978-3-16-148410-0"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Imprenta</label>
        <input type="text" name="publisher" placeholder="Ej: Planeta"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
        <select name="category_id" class="w-full border rounded-lg px-3 py-2">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
        <select name="authors[]" multiple class="w-full border rounded-lg px-3 py-2">
            @foreach($authors as $author)
            <option value="{{ $author->id }}">
                {{ $author->full_name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
            <input type="number" name="publish_year" placeholder="2024"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Páginas</label>
            <input type="number" name="pages" placeholder="200"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Idioma</label>
        <input type="text" name="language" placeholder="Español"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="description" rows="4" placeholder="Descripción del libro..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none"></textarea>
    </div>

    <div class="flex justify-end">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
            Guardar
        </button>
    </div>
</form>
@endsection