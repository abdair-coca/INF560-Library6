<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library App - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        fredoka: ['"Fredoka One"', 'cursive'],
                        nunito: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            yellow: '#FFD93D',
                            orange: '#FF6B35',
                            pink: '#FF6B9D',
                            blue: '#4ECDC4',
                            purple: '#A855F7',
                            green: '#6BCB77',
                            bg: '#FFF8F0',
                            dark: '#2D2D2D',
                        },
                    },
                    boxShadow: {
                        neo: '4px 4px 0px #2D2D2D',
                        'neo-hover': '7px 7px 0px #2D2D2D',
                        'neo-sm': '2px 2px 0px #2D2D2D',
                        'neo-btn': '3px 3px 0px #2D2D2D',
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-brand-bg font-nunito text-brand-dark min-h-screen">
    <nav class="bg-brand-yellow border-b-[3px] border-brand-dark px-6 md:px-8 py-3 sticky top-0 z-50">
        <div class="flex items-center justify-between flex-wrap gap-3">

            <a href="{{ route('books.index') }}"
                class="font-fredoka text-2xl text-brand-dark flex items-center gap-2 hover:rotate-[-2deg] transition-transform">
                📚 LibraryApp
            </a>

            <div class="hidden md:flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('books.index') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    📖 Catálogo
                </a>
                <a href="{{ route('authors.index') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ✏️ Autores
                </a>
                <a href="{{ route('categories.index') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    🏷️ Categorías
                </a>

                @auth
                <a href="{{ route('profile') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-blue shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    😊 Mi Perfil
                </a>

                @role('librarian')
                <a href="{{ route('books.create') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-orange shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ➕ Libro
                </a>
                @endrole

                @role('admin')
                <a href="{{ route('categories.create') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-purple shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ➕ Categoría
                </a>
                @endrole

                <div class="flex items-center gap-2 ml-1 pl-3 border-l-2 border-brand-dark/20">
                    <div
                        class="w-10 h-10 rounded-full border-[2.5px] border-brand-dark bg-brand-pink flex items-center justify-center text-lg shadow-neo-btn">
                        😊
                    </div>
                    <div class="hidden lg:flex flex-col leading-tight">
                        <span class="font-fredoka text-sm text-brand-dark">{{ Auth::user()->name }}</span>
                        <span class="font-extrabold text-[10px] uppercase opacity-70 tracking-wider">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-pink shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                        🚪 Cerrar sesión
                    </button>
                </form>
                @endauth

                @guest
                {{-- Botones para visitantes no autenticados --}}
                <a href="{{ route('login') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    🔑 Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-orange shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ✨ Registrarse
                </a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6 md:px-6">
        @if(session('success'))
        <div
            class="bg-brand-green border-[3px] border-brand-dark rounded-[20px] px-5 py-4 shadow-neo mb-6 flex items-center gap-3 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-white/20 rounded-full pointer-events-none"></div>
            <span class="text-3xl">🎉</span>
            <p class="font-extrabold text-brand-dark text-sm md:text-base">{{ session('success') }}</p>
        </div>
        @endif

        @yield('content')
    </main>

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
</body>

</html>
