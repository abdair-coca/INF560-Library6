<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library App - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-800 text-white p-4 shadow-md">
        {{-- Dentro de <nav>, en la sección de enlaces (md:flex) --}}
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('books.index') }}"
                class="hover:text-amber-300 transition">Catálogo</a>
            <a href="{{ route('authors.index') }}"
                class="hover:text-amber-300 transition">Autores</a>
            <a href="{{ route('categories.index') }}"
                class="hover:text-amber-300 transition">Categorias</a>
            <a href="{{ route('books.trashed') }}"
                class="hover:text-amber-300 transition text-slate-400 text-sm">
                Eliminados
            </a>
            <a href="{{ route('books.create') }}"
                class="bg-amber-600 hover:bg-amber-700 px-3 py-1 rounded text-sm">
                + Libro
            </a>
            <a href="{{ route('authors.create') }}"
                class="border border-slate-500 hover:border-white px-3 py-1 rounded text-sm">
                + Autor
            </a>
            <a href="{{ route('categories.create') }}"
                class="border border-slate-500 hover:border-white px-3 py-1 rounded text-sm">
                + Categoria
            </a>
        </div>
    </nav>

    <main class="container mx-auto p-4 mt-6">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
        @endif


        @yield('content')
    </main>
</body>
<script>
    let currentForm = null;

    function openModal(formId, modalId) {
        currentForm = document.getElementById(formId);

        const modal = document.getElementById(modalId);

        modal.classList.remove('hidden');
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);

        modal.classList.add('hidden');

        currentForm = null;
    }

    function confirmAction(modalId) {
        if (currentForm) {
            currentForm.submit();
        }

        closeModal(modalId);
    }
</script>
</html>