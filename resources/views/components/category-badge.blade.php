@props(['category'])

@if($category)
<span
    class="inline-flex items-center gap-1 text-[11px] font-extrabold px-3 py-0.5 rounded-full border-2 border-brand-dark shadow-neo-sm bg-white text-brand-dark">
    <span class="w-2 h-2 rounded-full border border-brand-dark/40"
        style="background-color: {{ $category->color }};"></span>
    {{ $category->name }}
</span>
@endif
