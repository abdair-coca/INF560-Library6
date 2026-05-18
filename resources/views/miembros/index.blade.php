@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    {{-- Welcome Banner --}}
    <div class="bg-brand-blue border-[3px] border-brand-dark rounded-[20px] p-7 mb-7 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="absolute -left-8 -top-8 w-24 h-24 bg-white/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">👥 Miembros</h1>
            <p class="text-white/90 font-bold text-sm mt-1">Comunidad de lectores de la biblioteca</p>
        </div>
        <span class="text-7xl">🦸</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($members as $member)
        <x-membership-card :member="$member" />
        @endforeach
    </div>
</div>
@endsection
