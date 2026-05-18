@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-5xl mx-auto py-6 space-y-6">

    {{-- Welcome banner --}}
    <div class="bg-brand-orange border-[3px] border-brand-dark rounded-[20px] p-7 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="absolute -left-8 -top-8 w-24 h-24 bg-white/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">¡Hola, {{ $user->name }}! 👋</h1>
            <p class="text-white/90 font-bold text-sm mt-1">Bienvenid@ a tu perfil de lector</p>
        </div>
        <span class="text-7xl">😊</span>
    </div>

    {{-- Información del usuario --}}
    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-purple px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            🪪 Mi Perfil
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">😊 Nombre</p>
                    <p class="font-extrabold text-brand-dark mt-1">{{ $user->name }}</p>
                </div>
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">📧 Correo electrónico</p>
                    <p class="font-extrabold text-brand-dark mt-1">{{ $user->email }}</p>
                </div>
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">🛡️ Rol</p>
                    <span class="inline-block mt-1.5 text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark shadow-neo-sm
                        {{ $user->role === 'admin' ? 'bg-brand-pink text-white' :
                          ($user->role === 'librarian' ? 'bg-brand-blue text-white' :
                           'bg-brand-green text-brand-dark') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Información del miembro --}}
    @if($user->member)
    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-pink px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            🎫 Membresía
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-brand-yellow border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-dark flex items-center gap-1">🆔 Código de miembro</p>
                    <p class="font-fredoka text-lg text-brand-orange mt-1">{{ $user->member->member_code }}</p>
                </div>
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">⭐ Tipo de membresía</p>
                    <p class="font-extrabold text-brand-dark mt-1">{{ ucfirst($user->member->membership_type) }}</p>
                </div>
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">📅 Vence el</p>
                    <p class="font-extrabold text-brand-dark mt-1">
                        {{ $user->member->membership_expires_at
                            ? $user->member->membership_expires_at->format('d/m/Y')
                            : 'Sin vencimiento' }}
                    </p>
                </div>
                <div class="bg-brand-blue/30 border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">📤 Préstamos activos</p>
                    <p class="font-fredoka text-2xl text-brand-dark mt-1">
                        {{ $user->member->activeLoans->count() }} <span class="text-base opacity-60">/ {{ $user->member->max_loans }}</span>
                    </p>
                </div>
                <div class="bg-brand-bg border-2 border-brand-dark rounded-2xl p-4 shadow-neo-sm">
                    <p class="font-fredoka text-xs text-brand-purple flex items-center gap-1">📊 Estado</p>
                    @if($user->member->is_membership_active)
                        <span class="inline-block mt-1.5 text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark bg-brand-green text-brand-dark shadow-neo-sm">✅ Activa</span>
                    @else
                        <span class="inline-block mt-1.5 text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark bg-brand-pink text-white shadow-neo-sm">⛔ Inactiva</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de préstamos activos --}}
    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        <div class="bg-brand-orange px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            📚 Préstamos Activos
        </div>

        @php
            $activeLoans = $user->member->loans->whereNull('returned_date');
        @endphp

        @if($activeLoans->isEmpty())
            <div class="p-8 text-center">
                <span class="text-5xl block mb-2">📭</span>
                <p class="font-fredoka text-brand-purple">No tienes préstamos activos</p>
                <p class="text-sm font-bold text-gray-500 mt-1">¡Es hora de descubrir un nuevo libro!</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-brand-yellow border-b-[2.5px] border-brand-dark">
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">📖 Libro</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">📅 Fecha préstamo</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">⏰ Fecha devolución</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">📊 Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeLoans as $loan)
                    <tr class="border-b border-dashed border-gray-200 hover:bg-orange-50 transition-colors">
                        <td class="px-4 py-3 font-extrabold text-brand-dark flex items-center gap-2">
                            <div class="w-9 h-12 rounded-md border-2 border-brand-dark bg-brand-pink flex items-center justify-center text-lg shrink-0">📗</div>
                            {{ $loan->book->title }}
                        </td>
                        <td class="px-4 py-3 font-bold text-gray-600">
                            {{ $loan->loan_date->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 font-bold text-gray-600">
                            {{ $loan->due_date?->format('d/m/Y') ?? '—' }}
                        </td>
                        <td class="px-4 py-3">
                            @if($loan->is_overdue)
                                <span class="text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark bg-brand-pink text-white shadow-neo-sm">
                                    ⏰ Vencido
                                </span>
                            @else
                                <span class="text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark bg-brand-green text-brand-dark shadow-neo-sm">
                                    ✓ Al día
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    @else
    {{-- Usuario sin membresía (admin/librarian sin Member) --}}
    <div class="bg-brand-yellow border-[3px] border-brand-dark rounded-[20px] p-5 shadow-neo flex items-center gap-3">
        <span class="text-3xl">ℹ️</span>
        <p class="font-extrabold text-brand-dark text-sm">Este usuario no tiene un registro de membresía asociado.</p>
    </div>
    @endif

</div>
@endsection
