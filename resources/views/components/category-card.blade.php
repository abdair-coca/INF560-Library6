@props(['category'])

<div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full border border-gray-200 hover:shadow-lg transition">
    <div class="p-4 flex-grow">
        <a  href="{{ route('categories.show', $category) }}" class="text-blue-600 font-semibold hover:underline">{{$category->name}}</a>
    </div>
</div>