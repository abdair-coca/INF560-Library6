@props(['status'])

@php
    $styles = [
        'available'   => ['bg-brand-green', 'text-brand-dark', '✓', 'Disponible'],
        'unavailable' => ['bg-brand-orange', 'text-white', '📤', 'Prestado'],
        'maintenance' => ['bg-brand-yellow', 'text-brand-dark', '🛠️', 'Mantenimiento'],
    ];
    [$bg, $fg, $icon, $label] = $styles[$status] ?? ['bg-white', 'text-brand-dark', '•', ucfirst($status)];
@endphp

<span
    class="inline-flex items-center gap-1 text-[11px] font-extrabold px-3 py-0.5 rounded-full border-2 border-brand-dark shadow-neo-sm {{ $bg }} {{ $fg }}">
    <span>{{ $icon }}</span>
    {{ $label }}
</span>
