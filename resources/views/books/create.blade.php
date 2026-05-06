@extends('layouts.app')
@section('title', 'Registrar libro')
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Registrar Libro</h1>
    <form action="{{ route('books.store') }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @include('books._form', ['book' => null, 'selectedAuthors' => []])
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2 rounded">
                Guardar libro
            </button>
            <a href="{{ route('books.index') }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection