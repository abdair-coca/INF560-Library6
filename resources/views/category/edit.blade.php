@extends('layouts.app')
@section('title', 'Editar: ' . $category->name)
@section('content')
<div class="max-w-3xl mx-auto py-6">

    <div class="bg-brand-yellow border-[3px] border-brand-dark rounded-[20px] p-6 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-black/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-brand-dark">✏️ Editar Categoría</h1>
            <p class="font-bold text-sm text-brand-dark/80 mt-1">{{ $category->name }}</p>
        </div>
        <span class="text-6xl">🏷️</span>
    </div>

    <form action="{{ route('categories.update', $category) }}" method="POST"
        class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo p-7 space-y-5">
        @csrf
        @method('PUT')
        @include('category._form')
        <div class="flex gap-3 pt-3 border-t-2 border-dashed border-gray-200">
            <button type="submit"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                💾 Actualizar Categoría
            </button>
            <a href="{{ route('categories.show', $category) }}"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-white text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✖️ Cancelar
            </a>
        </div>
    </form>

    {{-- Eliminar --}}
    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="mt-5">
        @csrf
        @method('DELETE')
    </form>
    <button type="submit"
        class="mt-2 font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo"
        onclick="openModal('delete-category-form', 'delete-category-modal')">
        🗑️ Eliminar Categoría
    </button>
    <x-confirm-modal
        id="delete-category-modal"
        title="Eliminar categoria"
        message="Esta acción no se puede deshacer.">

        <button type="button"
            onclick="confirmAction('delete-categoria-modal')"
            class="font-fredoka text-base px-6 py-2.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">

            ✔️ Confirmar
        </button>

    </x-confirm-modal>
</div>
@endsection
