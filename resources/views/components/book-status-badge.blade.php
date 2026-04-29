@props(['status'])

@php
    $colors = [
        'available' => 'bg-green-100 text-green-800',
        'unavailable' => 'bg-red-100 text-red-800',
        'maintenance' => 'bg-yellow-100 text-yellow-800',
    ];
    $colorClass = $colors[$status] ?? 'bg-gray-100 text-gray-800';
@endphp

<span class="px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
    {{ ucfirst($status) }}
</span>