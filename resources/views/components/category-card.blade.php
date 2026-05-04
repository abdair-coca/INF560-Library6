@props(['category'])

@php
    $colors = [
    'Arte'           => 'bg-pink-100 text-pink-800',
    'Biografía'      => 'bg-amber-100 text-amber-800',
    'Ciencia'        => 'bg-cyan-100 text-cyan-800',
    'Ciencia Ficción'=> 'bg-violet-100 text-violet-800',
    'Filosofía'      => 'bg-indigo-100 text-indigo-800',
    'Historia'       => 'bg-orange-100 text-orange-800',
    'Infantil'       => 'bg-lime-100 text-lime-800',
    'Novela'         => 'bg-rose-100 text-rose-800',
    'Poesía'         => 'bg-purple-100 text-purple-800',
    'Tecnología'     => 'bg-teal-100 text-teal-800',
];
    $colorBack = $colors[$category->name] ?? 'bg-gray-100 text-gray-800';
@endphp

<div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full border border-gray-200 hover:shadow-lg transition">
    <div class="p-4 flex-grow {{ $colorBack }}">
        <a  href="{{ route('categories.show', $category) }}" class="text-blue-600 text-xl font-bold hover:underline">{{$category->name}}</a>
        <p> Cantidad de libros: {{$category->books_count}}</p>
    </div>
</div>