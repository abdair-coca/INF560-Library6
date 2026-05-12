@extends('layouts.app')
@section('title', 'Editar: ' . $author->full_name)
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">
        Editar: {{ $author->full_name }}
    </h1>
    <form action="{{ route('authors.update', $author) }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')
        @include('authors._form')
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded">
                Actualizar autor
            </button>
            <a href="{{ route('authors.show', $author) }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">Cancelar</a>
            @if($author->books_count === 0)
            <form action="{{ route('authors.destroy', $author) }}" method="POST"
                class="ml-auto">
                @csrf
                @method('DELETE')
            </form>
            <button type="submit"
                class="bg-red-600 text-white hover:bg-red-800 rounded px-2 py-2"
                onclick="openModal('delete-author-form', 'delete-author-modal')">
                Eliminar autor
            </button>
            <x-confirm-modal
                id="delete-author-modal"
                title="Eliminar autor"
                message="Esta acción no se puede deshacer.">

                <button type="button"
                    onclick="confirmAction('delete-auhtor-modal')"
                    class="rounded bg-red-600 px-4 py-2 text-white hover:bg-red-700">

                    Confirmar
                </button>

            </x-confirm-modal>
            @endif
        </div>
    </form>
</div>
@endsection