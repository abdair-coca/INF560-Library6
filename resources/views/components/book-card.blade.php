@props(['book'])

@php
    $coverPalette = ['bg-brand-pink', 'bg-brand-blue', 'bg-brand-yellow', 'bg-brand-purple', 'bg-brand-orange', 'bg-brand-green'];
    $coverEmojis  = ['📗', '📘', '📕', '📙', '📓', '📚'];
    $bookIdx      = abs(crc32((string) ($book->id ?? $book->title))) % count($coverPalette);
    $coverBg      = $coverPalette[$bookIdx];
    $coverEmoji   = $coverEmojis[$bookIdx];
@endphp

<a href="{{ route('books.show', $book) }}"
    class="group block bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">

    {{-- Portada --}}
    @if($book->cover_url)
    <div class="w-full aspect-[2/3] border-b-[3px] border-brand-dark overflow-hidden bg-brand-bg">
        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
            class="w-full h-full object-cover">
    </div>
    @else
    <div
        class="w-full aspect-[2/3] {{ $coverBg }} border-b-[3px] border-brand-dark flex items-center justify-center text-7xl relative overflow-hidden">
        <span class="drop-shadow-[2px_2px_0_rgba(0,0,0,0.15)]">{{ $coverEmoji }}</span>
        <div class="absolute inset-0 bg-gradient-to-br from-white/25 to-transparent pointer-events-none"></div>
    </div>
    @endif

    {{-- Información --}}
    <div class="p-4 space-y-2">
        <h3 class="font-fredoka text-lg leading-tight text-brand-dark line-clamp-2"
            title="{{ $book->title }}">
            {{ $book->title }}
        </h3>

        <p class="font-extrabold text-xs text-brand-orange line-clamp-1 flex items-center gap-1">
            <span>✏️</span>
            <span class="truncate">
                @foreach($book->authors as $author){{ $author->full_name }}@if(!$loop->last), @endif
                @endforeach
            </span>
        </p>

        <div class="flex flex-wrap gap-1.5 pt-1">
            <x-category-badge :category="$book->category" />
            <x-book-status-badge :status="$book->status" />
        </div>

        <p class="text-[11px] font-extrabold text-brand-dark/60 pt-1 flex items-center gap-1">
            📅 {{ $book->publish_year ?? 's/f' }}
        </p>
    </div>
</a>
