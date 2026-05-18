@extends('layouts.app')

@section('title', $author->full_name)

@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div class="mb-6">
        <a href="{{ route('authors.index') }}" class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo inline-flex items-center gap-1">
            ← Volver a Autores
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-[260px_1fr] gap-7">

        {{-- Avatar grande --}}
        <div class="aspect-square rounded-2xl border-[3px] border-brand-dark shadow-neo bg-brand-purple flex items-center justify-center text-8xl relative overflow-hidden">
            ✏️
            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
        </div>

        {{-- Info --}}
        <div class="flex flex-col gap-4">
            <div>
                <h1 class="font-fredoka text-4xl leading-tight text-brand-dark">{{ $author->full_name }}</h1>
                <p class="font-extrabold text-brand-orange flex items-center gap-1.5 mt-1">🖋️ Autor/a</p>
            </div>

            {{-- Chips de metadata --}}
            <div class="flex flex-wrap gap-3">
                <span class="bg-brand-blue px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm text-white">🌎 {{ $author->nationality }}</span>
                @if($author->birth_date)
                <span class="bg-brand-yellow px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">📅 {{ $author->birth_date->format('d/m/Y') }}</span>
                @endif
            </div>

            @if($author->biography)
            <div class="bg-white border-[2.5px] border-brand-dark rounded-2xl p-5 shadow-neo-sm">
                <p class="font-fredoka text-base text-brand-purple mb-2">📝 Biografía</p>
                <p class="text-sm font-semibold leading-relaxed text-gray-600">{{ $author->biography }}</p>
            </div>
            @endif

            {{-- Acciones --}}
            @role('admin')
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('authors.edit', $author->id) }}" class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ✏️ Editar
                </a>

                @if($author->books_count === 0)
                <form id="delete-author-form"
                    action="{{ route('authors.destroy', $author) }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')
                </form>
                <button type="button"
                    onclick="openModal('delete-author-form', 'delete-author-modal')"
                    class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">

                    🗑️ Eliminar autor
                </button>
                <x-confirm-modal
                    id="delete-author-modal"
                    title="Eliminar autor"
                    message="Esta acción no se puede deshacer.">

                    <button type="button"
                        onclick="confirmAction('delete-autor-modal')"
                        class="font-fredoka text-base px-6 py-2.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">

                        ✔️ Confirmar
                    </button>

                </x-confirm-modal>
                @endif
            </div>
            @endrole
        </div>
    </div>

    @if($author->books->count() > 0)
    <div class="mt-10">
        <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">
            <div class="bg-brand-orange px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
                📚 Libros del autor
            </div>
            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($author->books as $book)
                <article class="bg-brand-bg border-[2.5px] border-brand-dark rounded-2xl shadow-neo-sm p-4 transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    <div class="w-12 h-16 rounded-md border-2 border-brand-dark bg-brand-pink flex items-center justify-center text-2xl mb-2">
                        📗
                    </div>
                    <h3 class="font-fredoka text-lg text-brand-dark leading-tight">{{ $book->title }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-1">📅 {{ $book->publish_year }}</p>
                    <a href="{{ route('books.show', $book->id) }}" class="inline-block mt-2 font-nunito font-extrabold text-xs px-3 py-1 rounded-full border-2 border-brand-dark bg-brand-blue text-white shadow-neo-sm">
                        👁️ Ver libro
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
