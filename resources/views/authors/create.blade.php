@extends('layouts.app')
@section('title', 'Registrar autor')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Registrar Autor</h1>
    <form action="{{ route('authors.store') }}" method="POST"
        class="bg-white rounded shadow-sm p-6 space-y-4">
        @csrf
        @include('authors._form', ['author' => null])
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2 rounded">
                Guardar autor
            </button>
            <a href="{{ route('authors.index') }}"
                class="text-slate-600 hover:text-slate-900 px-4 py-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection