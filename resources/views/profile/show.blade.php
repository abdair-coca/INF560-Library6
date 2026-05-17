@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-4xl mx-auto mt-10 space-y-6">

    {{-- Información del usuario --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-slate-800 mb-6">Mi Perfil</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-slate-500">Nombre</p>
                <p class="font-medium text-slate-800">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Correo electrónico</p>
                <p class="font-medium text-slate-800">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Rol</p>
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' :
                      ($user->role === 'librarian' ? 'bg-blue-100 text-blue-700' :
                       'bg-green-100 text-green-700') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Información del miembro --}}
    @if($user->member)
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Membresía</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-slate-500">Código de miembro</p>
                <p class="font-mono font-medium text-amber-600">{{ $user->member->member_code }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Tipo de membresía</p>
                <p class="font-medium text-slate-800">{{ ucfirst($user->member->membership_type) }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Vence el</p>
                <p class="font-medium text-slate-800">
                    {{ $user->member->membership_expires_at
                        ? $user->member->membership_expires_at->format('d/m/Y')
                        : 'Sin vencimiento' }}
                </p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Préstamos activos</p>
                <p class="font-medium text-slate-800">
                    {{ $user->member->activeLoans->count() }} / {{ $user->member->max_loans }}
                </p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Estado</p>
                @if($user->member->is_membership_active)
                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Activa</span>
                @else
                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Inactiva</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Tabla de préstamos activos --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Préstamos Activos</h2>

        @php
            $activeLoans = $user->member->loans->whereNull('returned_date');
        @endphp

        @if($activeLoans->isEmpty())
            <p class="text-slate-500 text-sm">No tienes préstamos activos.</p>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white">
                        <th class="px-4 py-3 text-left">Libro</th>
                        <th class="px-4 py-3 text-left">Fecha préstamo</th>
                        <th class="px-4 py-3 text-left">Fecha devolución</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeLoans as $loan)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="px-4 py-3 font-medium text-slate-800">
                            {{ $loan->book->title }}
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            {{ $loan->loan_date->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            {{ $loan->due_date?->format('d/m/Y') ?? '—' }}
                        </td>
                        <td class="px-4 py-3">
                            @if($loan->is_overdue)
                                <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                                    Vencido
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                    Al día
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
    <div class="bg-amber-50 border border-amber-300 rounded-xl p-4 text-amber-800 text-sm">
        Este usuario no tiene un registro de membresía asociado.
    </div>
    @endif

</div>
@endsection