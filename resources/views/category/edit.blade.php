@extends('layouts.app')
@section('title', 'Editar: ' . $category->name)
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">
        Editar: {{ $category->name }}
    </h1>
    <form action="{{ route('categories.update', $category) }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @method('PUT')
        @include('category._form')
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded">
                Actualizar Categoria
            </button>
            <a href="{{ route('categories.show', $category) }}"
                class="bg-gray-200 text-black rounded hover:bg-slate-300 px-4 py-2">
                Cancelar
            </a>
        </div>
    </form>

    {{-- Eliminar --}}
    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
    </form>
    <button type="submit"
        class="bg-red-600 text-white hover:bg-red-800 rounded px-2 py-2"
        onclick="openModal('delete-category-form', 'delete-category-modal')">
        Eliminar Categoria
    </button>
    <x-confirm-modal
        id="delete-category-modal"
        title="Eliminar categoria"
        message="Esta acción no se puede deshacer.">

        <button type="button"
            onclick="confirmAction('delete-categoria-modal')"
            class="rounded bg-red-600 px-4 py-2 text-white hover:bg-red-700">

            Confirmar
        </button>

    </x-confirm-modal>
</div>
@endsection