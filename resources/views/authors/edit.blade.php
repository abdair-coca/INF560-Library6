@extends('layouts.app')
@section('title', 'Editar: ' . $author->full_name)
@section('content')
<div class="max-w-2xl mx-auto py-6">

    <div class="bg-brand-yellow border-[3px] border-brand-dark rounded-[20px] p-6 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-black/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-brand-dark">✏️ Editar Autor</h1>
            <p class="font-bold text-sm text-brand-dark/80 mt-1">{{ $author->full_name }}</p>
        </div>
        <span class="text-6xl">🖊️</span>
    </div>

    <form action="{{ route('authors.update', $author) }}" method="POST"
        class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo p-7 space-y-5">
        @csrf
        @method('PUT')
        @include('authors._form')
        <div class="flex gap-3 pt-3 border-t-2 border-dashed border-gray-200 flex-wrap">
            <button type="submit"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                💾 Actualizar autor
            </button>
            <a href="{{ route('authors.show', $author) }}"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-white text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✖️ Cancelar
            </a>
            @if($author->books_count === 0)
            <form action="{{ route('authors.destroy', $author) }}" method="POST"
                class="ml-auto">
                @csrf
                @method('DELETE')
            </form>
            <button type="submit"
                class="ml-auto font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo"
                onclick="openModal('delete-author-form', 'delete-author-modal')">
                🗑️ Eliminar autor
            </button>
            <x-confirm-modal
                id="delete-author-modal"
                title="Eliminar autor"
                message="Esta acción no se puede deshacer.">

                <button type="button"
                    onclick="confirmAction('delete-auhtor-modal')"
                    class="font-fredoka text-base px-6 py-2.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">

                    ✔️ Confirmar
                </button>

            </x-confirm-modal>
            @endif
        </div>
    </form>
</div>
@endsection
