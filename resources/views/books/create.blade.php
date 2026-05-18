@extends('layouts.app')
@section('title', 'Registrar libro')
@section('content')
<div class="max-w-3xl mx-auto py-6">

    <div class="bg-brand-orange border-[3px] border-brand-dark rounded-[20px] p-6 mb-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-24 h-24 bg-white/15 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">📚 Registrar Libro</h1>
            <p class="font-bold text-sm text-white/90 mt-1">Añade un nuevo libro al catálogo</p>
        </div>
        <span class="text-6xl">📗</span>
    </div>

    @if ($errors->any())
    <div class="mb-5 bg-brand-pink border-[3px] border-brand-dark rounded-[20px] px-5 py-4 shadow-neo">
        <p class="font-fredoka text-base text-white mb-2 flex items-center gap-2">
            ⚠️ Por favor corrige los siguientes errores:
        </p>
        <ul class="list-disc list-inside text-white font-extrabold text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST"
        class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo p-7 space-y-5">
        @csrf
        @include('books._form', ['book' => null, 'selectedAuthors' => []])
        <div class="flex gap-3 pt-3 border-t-2 border-dashed border-gray-200">
            <button type="submit"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                💾 Guardar libro
            </button>
            <a href="{{ route('books.index') }}"
                class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-white text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                ✖️ Cancelar
            </a>
        </div>
    </form>

</div>
@endsection
