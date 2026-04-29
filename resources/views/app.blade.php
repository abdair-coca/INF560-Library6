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
        <div class="container mx-auto flex gap-4">
            <a href="{{ route('books.index') }}" class="font-bold hover:text-blue-200">Libros</a>
            <a href="{{ route('authors.index') }}" class="font-bold hover:text-blue-200">Autores</a>
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
</html>