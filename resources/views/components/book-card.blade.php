@props(['book'])

@props(['book'])

<a href="{{ route('books.show', $book) }}"
    class="block bg-white rounded shadow-sm hover:shadow-md transition overflowhidden">
    {{-- Portada --}}
    @if($book->cover_url)
    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
        class="w-full aspect-[2/3] object-cover">
    @else
    <div class="w-full aspect-[2/3] bg-slate-200 flex items-center justify-center
text-slate-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12"
            fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5 S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18" />
        </svg>
    </div>
    @endif
    {{-- Información --}}
    <div class="p-3 space-y-2">
        <h3 class="font-semibold text-slate-900 line-clamp-2" title="{{ $book->title }}">
            {{ $book->title }}
        </h3>
        <p class="text-xs text-slate-600 line-clamp-1">
            @foreach($book->authors as $author){{ $author->full_name }}@if(!$loop->last), @endif
            @endforeach
        </p>
        <div class="flex flex-wrap gap-1">
            <x-category-badge :category="$book->category" />
            <x-book-status-badge :status="$book->status" />
        </div>
        <p class="text-xs text-slate-500">
            {{ $book->publish_year ?? 's/f' }}
        </p>
    </div>
</a>