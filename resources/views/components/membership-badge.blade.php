@props(['member'])

@php
    $colors = [
    'standart'       => 'bg-brand-blue text-white',
    'premium'        => 'bg-brand-yellow text-brand-dark',
    'student'        => 'bg-brand-green text-brand-dark',
];
    $emojis = [
    'standart'       => '🪪',
    'premium'        => '⭐',
    'student'        => '🎓',
];
    $colorBack = $colors[$member->membership_type] ?? 'bg-brand-pink text-white';
    $emoji = $emojis[$member->membership_type] ?? '🎫';
@endphp

<span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-extrabold rounded-full border-2 border-brand-dark shadow-neo-sm {{ $colorBack }}">
    {{ $emoji }} {{ $member->membership_type }}
</span>
