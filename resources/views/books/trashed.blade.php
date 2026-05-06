@extends('layouts.app')
@section('title', 'Libros eliminados')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Libros eliminados</h1>
    <a href="{{ route('books.index') }}"
        class="text-sm text-slate-600 hover:text-slate-900">← Volver al catálogo</a>
</div>
@if($books->isEmpty())
<p class="text-slate-500 italic">No hay libros eliminados.</p>
@else
<div class="bg-white shadow-sm rounded overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-900 text-white text-left text-sm">
            <tr>
                <th class="px-4 py-3">Título</th>
                <th class="px-4 py-3">Categoría</th>
                <th class="px-4 py-3">Eliminado el</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr class="border-b border-slate-100 {{ $loop->even ? 'bg-slate-50' : ''
}}">
                <td class="px-4 py-3 font-medium text-slate-700">{{ $book->title
}}</td>
                <td class="px-4 py-3 text-slate-500">{{ $book->category->name ?? '—'
}}</td>
                <td class="px-4 py-3 text-slate-500 text-sm">
                    {{ $book->deleted_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-4 py-3 text-right">
                    <form action="{{ route('books.restore', $book) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="text-sm text-green-700 hover:underline">
                            Restaurar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $books->links() }}</div>
@endif
@endsection