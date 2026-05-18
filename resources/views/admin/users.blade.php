@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="bg-brand-purple border-[3px] border-brand-dark rounded-[20px] p-7 my-6 flex items-center justify-between shadow-neo relative overflow-hidden">
        <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
        <div class="absolute -left-8 -top-8 w-24 h-24 bg-white/10 rounded-full"></div>
        <div>
            <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">🛡️ Gestión de Usuarios</h1>
            <p class="text-white/90 font-bold text-sm mt-1">Administra los roles de los miembros del sistema</p>
        </div>
        <span class="text-7xl">👥</span>
    </div>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="bg-brand-green border-[3px] border-brand-dark rounded-[20px] px-5 py-4 mb-5 font-extrabold text-brand-dark shadow-neo flex items-center gap-2">
            <span class="text-2xl">✅</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-brand-pink border-[3px] border-brand-dark rounded-[20px] px-5 py-4 mb-5 font-extrabold text-white shadow-neo flex items-center gap-2">
            <span class="text-2xl">⚠️</span>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">
        <div class="bg-brand-orange px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
            🧑‍💼 Lista de Usuarios
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-brand-yellow border-b-[2.5px] border-brand-dark">
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">#</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">Nombre</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">Email</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">Rol actual</th>
                        <th class="px-4 py-3 text-left font-fredoka text-base text-brand-dark">Cambiar rol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-dashed border-gray-200 hover:bg-orange-50 transition-colors">
                        <td class="px-4 py-3 font-fredoka text-brand-orange text-lg">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-extrabold text-brand-dark">{{ $user->name }}</td>
                        <td class="px-4 py-3 font-semibold text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-extrabold px-3 py-1 rounded-full border-2 border-brand-dark shadow-neo-sm
                                {{ $user->role === 'admin' ? 'bg-brand-pink text-white' :
                                  ($user->role === 'librarian' ? 'bg-brand-blue text-white' :
                                   'bg-brand-green text-brand-dark') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($user->id === auth()->id())
                                {{-- El admin no puede cambiarse su propio rol --}}
                                <select class="font-nunito font-bold text-sm px-3 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-gray-100 shadow-neo-sm" disabled>
                                    <option>{{ $user->role }}</option>
                                </select>
                                <small class="block mt-1 text-xs font-bold text-brand-purple">✨ Tu propio rol</small>
                            @else
                                <form action="{{ route('admin.users.updateRole', $user) }}"
                                      method="POST"
                                      class="flex gap-2 items-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="font-nunito font-bold text-sm px-3 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-sm">
                                        @foreach(['admin', 'librarian', 'member'] as $role)
                                            <option value="{{ $role }}"
                                                {{ $user->role === $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="font-fredoka text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                                        💾 Actualizar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
