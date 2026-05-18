@props(['category'])

@php
    $palette = [
        'Arte'             => ['bg-brand-pink', 'text-brand-dark', '🎨'],
        'Biografía'        => ['bg-brand-yellow', 'text-brand-dark', '📜'],
        'Ciencia'          => ['bg-brand-blue', 'text-brand-dark', '🔬'],
        'Ciencia Ficción'  => ['bg-brand-purple', 'text-white', '🚀'],
        'Filosofía'        => ['bg-brand-purple', 'text-white', '🧠'],
        'Historia'         => ['bg-brand-orange', 'text-white', '🏛️'],
        'Infantil'         => ['bg-brand-green', 'text-brand-dark', '🧸'],
        'Novela'           => ['bg-brand-pink', 'text-brand-dark', '📖'],
        'Poesía'           => ['bg-brand-purple', 'text-white', '🪶'],
        'Tecnología'       => ['bg-brand-blue', 'text-brand-dark', '💻'],
    ];
    [$bg, $fg, $emoji] = $palette[$category->name] ?? ['bg-brand-yellow', 'text-brand-dark', '🏷️'];
@endphp

<a href="{{ route('categories.show', $category) }}"
    class="group block {{ $bg }} {{ $fg }} border-[3px] border-brand-dark rounded-[20px] shadow-neo p-6 transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover relative overflow-hidden">

    {{-- emoji decorativo de fondo --}}
    <span
        class="absolute right-3 bottom-2 text-7xl opacity-20 leading-none pointer-events-none select-none">
        {{ $emoji }}
    </span>

    <div class="relative flex flex-col gap-2">
        <span class="text-4xl">{{ $emoji }}</span>
        <span class="font-fredoka text-2xl leading-tight">{{ $category->name }}</span>
        <span class="font-extrabold text-xs opacity-80 flex items-center gap-1">
            📚 {{ $category->books_count }} libro{{ $category->books_count == 1 ? '' : 's' }}
        </span>
    </div>
</a>
