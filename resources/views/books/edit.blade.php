@extends('layouts.app')
@section('title', 'Editar: ' . $book->title)
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">
        Editar: {{ $book->title }}
    </h1>
    <form action="{{ route('books.update', $book) }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')
        @include('books._form', ['selectedAuthors' => $selectedAuthors])
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded">
                Actualizar libro
            </button>
            <a href="{{ route('books.show', $book) }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">
                Cancelar
            </a>
        </div>
    </form>

    {{-- Eliminar --}}
    <form id="delete-book-form"
        action="{{ route('books.destroy', $book) }}"
        method="POST"
        class="mt-4">

        @csrf
        @method('DELETE')
    </form>
    <button type="button"
        onclick="openModal('delete-book-form', 'delete-book-modal')"
        class="bg-red-600 text-white hover:bg-red-800 rounded px-2 py-2">

        Eliminar libro
    </button>
    <x-confirm-modal
        id="delete-book-modal"
        title="Eliminar libro"
        message="Esta acción no se puede deshacer.">

        <button type="button"
            onclick="confirmAction('delete-book-modal')"
            class="rounded bg-red-600 px-4 py-2 text-white hover:bg-red-700">

            Confirmar
        </button>

    </x-confirm-modal>
</div>
@endsection