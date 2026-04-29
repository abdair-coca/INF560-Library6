@props(['category'])

<span class="px-2 py-1 text-xs font-semibold rounded" style="background-color: {{ $category->color }}33; color: {{ $category->color }};">
    {{ $category->name }}
</span>