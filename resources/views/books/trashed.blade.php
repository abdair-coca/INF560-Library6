@extends('layouts.app')
@section('title', 'Libros eliminados')
@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="bg-brand-pink border-[3px] border-brand-dark rounded-[20px] p-6 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="flex items-center gap-4">
            <span class="text-6xl">🗑️</span>
            <div>
                <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">Libros eliminados</h1>
                <p class="text-white/90 font-bold text-sm mt-1">Restaura los libros que ya no están activos</p>
            </div>
        </div>
        <a href="{{ route('books.index') }}"
            class="font-nunito font-extrabold text-sm px-4 py-2 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
            ← Volver al catálogo
        </a>
    </div>

    @if($books->isEmpty())
    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo p-10 text-center">
        <span class="text-6xl block mb-3">📭</span>
        <p class="font-fredoka text-xl text-brand-purple">No hay libros eliminados</p>
        <p class="text-sm font-bold text-gray-500 mt-1">El cesto está vacío ✨</p>
    </div>
    @else
    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-purple px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            🗂️ Papelera de libros
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-brand-yellow border-b-[2.5px] border-brand-dark">
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">📖 Título</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">🏷️ Categoría</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">📅 Eliminado el</th>
                        <th class="px-4 py-3 text-right font-fredoka text-base text-brand-dark">⚡ Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="border-b border-dashed border-gray-200 hover:bg-orange-50 transition-colors {{ $loop->even ? 'bg-brand-bg/50' : 'bg-white' }}">
                        <td class="px-4 py-3 font-extrabold text-brand-dark">{{ $book->title }}</td>
                        <td class="px-4 py-3 font-bold text-gray-600">{{ $book->category->name ?? '—' }}</td>
                        <td class="px-4 py-3 font-semibold text-gray-500 text-sm">
                            ⏰ {{ $book->deleted_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <form action="{{ route('books.restore', $book) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="font-nunito font-extrabold text-xs px-4 py-1.5 rounded-full border-2 border-brand-dark bg-brand-green text-brand-dark shadow-neo-btn transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                                    ♻️ Restaurar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6 flex justify-center">{{ $books->links() }}</div>
    @endif
</div>
@endsection
