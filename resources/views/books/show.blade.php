@extends('layouts.app')
@section('title', $book->title)
@section('content')

{{-- ===== Volver ===== --}}
<a href="{{ route('books.index') }}"
    class="inline-flex items-center gap-1.5 font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo mb-6">
    ← Volver al catálogo
</a>

<div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-7">

    {{-- ===== Columna izquierda: portada ===== --}}
    <aside class="lg:col-span-1">
        @if($book->cover_url)
        <div
            class="aspect-[2/3] rounded-2xl border-[3px] border-brand-dark shadow-neo overflow-hidden bg-brand-bg">
            <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
                class="w-full h-full object-cover">
        </div>
        @else
        <div
            class="aspect-[2/3] rounded-2xl border-[3px] border-brand-dark shadow-neo bg-brand-pink flex items-center justify-center text-8xl relative overflow-hidden">
            <span class="drop-shadow-[3px_3px_0_rgba(0,0,0,0.2)]">📗</span>
            <div class="absolute inset-0 bg-gradient-to-br from-white/25 to-transparent pointer-events-none"></div>
        </div>
        @endif
    </aside>

    {{-- ===== Columna derecha: información ===== --}}
    <div class="flex flex-col gap-5">

        <header>
            <h1 class="font-fredoka text-4xl md:text-5xl leading-tight text-brand-dark">
                {{ $book->title }}
            </h1>
            <p class="font-extrabold text-brand-orange flex items-center gap-1.5 mt-2 text-base">
                ✏️
                <span>
                    @foreach($book->authors as $author)
                    <a href="{{ route('authors.show', $author) }}"
                        class="hover:underline">{{ $author->full_name }}</a>@if(!$loop->last), @endif
                    @endforeach
                </span>
            </p>
        </header>

        {{-- Chips de metadata --}}
        <div class="flex flex-wrap gap-2">
            @if($book->isbn)
            <span
                class="bg-brand-blue px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">
                📚 ISBN: {{ $book->isbn }}
            </span>
            @endif
            @if($book->publish_year)
            <span
                class="bg-brand-yellow px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">
                📅 {{ $book->publish_year }}
            </span>
            @endif
            @if($book->pages)
            <span
                class="bg-brand-green px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">
                📄 {{ $book->pages }} páginas
            </span>
            @endif
            @if($book->publisher)
            <span
                class="bg-brand-pink text-white px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">
                🏢 {{ $book->publisher }}
            </span>
            @endif
            @if($book->language)
            <span
                class="bg-brand-purple text-white px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">
                🌐 {{ $book->language }}
            </span>
            @endif
        </div>

        {{-- Categoría + estado --}}
        <div class="flex items-center gap-2 flex-wrap">
            <x-category-badge :category="$book->category" />
            <x-book-status-badge :status="$book->status" />
        </div>

        {{-- Descripción --}}
        @if($book->description)
        <article
            class="bg-white border-[2.5px] border-brand-dark rounded-2xl p-5 shadow-neo-sm">
            <p class="font-fredoka text-base text-brand-purple mb-2 flex items-center gap-2">
                📝 Descripción
            </p>
            <p class="text-sm font-semibold leading-relaxed text-brand-dark/70">
                {{ $book->description }}
            </p>
        </article>
        @endif

        {{-- Disponibilidad --}}
        <article
            class="bg-brand-yellow border-[2.5px] border-brand-dark rounded-2xl p-5 shadow-neo-sm flex items-center justify-between gap-4">
            <div>
                <p class="font-fredoka text-base text-brand-dark mb-1 flex items-center gap-2">
                    📦 Disponibilidad
                </p>
                <p class="font-extrabold text-sm text-brand-dark/80">
                    <span class="font-fredoka text-3xl text-brand-dark align-middle">
                        {{ $book->available_copies }}
                    </span>
                    <span class="text-brand-dark/60">/ {{ $book->total_copies }} copias libres</span>
                </p>
            </div>
            <span class="text-5xl">{{ $book->available_copies > 0 ? '✅' : '⏳' }}</span>
        </article>

        @role('librarian')
        {{-- Acciones --}}
        <div class="flex gap-3 flex-wrap pt-2">
            <a href="{{ route('books.edit', $book) }}"
                class="font-fredoka text-base px-6 py-2.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✏️ Editar libro
            </a>

            <form id="delete-book-form"
                action="{{ route('books.destroy', $book) }}"
                method="POST">
                @csrf
                @method('DELETE')
            </form>

            <button type="button"
                onclick="openModal('delete-book-form', 'delete-book-modal')"
                class="font-fredoka text-base px-6 py-2.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                🗑️ Eliminar libro
            </button>

            <x-confirm-modal
                id="delete-book-modal"
                title="Eliminar libro"
                message="Esta acción no se puede deshacer.">

                <button type="button"
                    onclick="confirmAction('delete-book-modal')"
                    class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark bg-brand-pink text-white shadow-neo-btn transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    🗑️ Confirmar
                </button>

            </x-confirm-modal>
        </div>
        @endrole

        {{-- ===== Préstamos activos ===== --}}
        @if($book->activeLoans->isNotEmpty())
        <section
            class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden mt-2">

            <div
                class="bg-brand-purple px-5 py-3 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
                📤 Préstamos activos
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-brand-bg border-b-2 border-dashed border-brand-dark/20">
                        <tr class="font-fredoka text-brand-dark">
                            <th class="text-left px-5 py-3">Miembro</th>
                            <th class="text-left px-5 py-3">📅 Fecha préstamo</th>
                            <th class="text-left px-5 py-3">⏰ Devolución</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book->activeLoans as $loan)
                        <tr class="border-b border-dashed border-gray-200 font-bold hover:bg-orange-50 transition-colors">
                            <td class="px-5 py-3 text-brand-dark">
                                {{ $loan->member->user->name ?? '—' }}
                            </td>
                            <td class="px-5 py-3 text-brand-dark/70">
                                {{ $loan->loaned_at?->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-3 text-brand-dark/70">
                                {{ $loan->due_at?->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif
    </div>
</div>
@endsection
