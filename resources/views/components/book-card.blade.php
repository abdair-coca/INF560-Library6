@props(['book'])

<div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full border border-gray-200 hover:shadow-lg transition">
    <div class="p-4 flex-grow">
        <h3 class="text-xl font-bold mb-2">{{ $book->title }}</h3>
        
        <div class="mb-3">
            @if($book->category)
                <x-category-badge :category="$book->category" />
            @endif
        </div>
        
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $book->description }}</p>
        
        <div class="mt-auto">
            <x-book-status-badge :status="$book->status" />
            <p class="text-xs text-gray-500 mt-2">Páginas: {{ $book->pages }}</p>
        </div>
    </div>
    <div class="bg-gray-50 p-3 border-t text-center">
        <a href="{{ route('books.show', $book) }}" class="text-blue-600 font-semibold hover:underline">Ver Detalles</a>
    </div>
</div>