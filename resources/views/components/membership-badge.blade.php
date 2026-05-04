@props(['member'])

@php
    $colors = [
    'standart'       => 'bg-slate-200 text-slate-800',
    'premium'        => 'bg-amber-200 text-amber-900',
    'student'        => 'bg-blue-100 text-blue-800',
];
    $colorBack = $colors[$member->membership_type] ?? 'bg-gray-100 text-gray-800';
@endphp

<span class="px-2 py-1 text-xs font-semibold rounded {{ $colorBack }}">
    {{ $member->membership_type }}
</span>