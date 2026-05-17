@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Gestión de Usuarios</h1>

    {{-- Mensajes flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol actual</th>
                <th>Cambiar rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-secondary">{{ $user->role }}</span>
                </td>
                <td>
                    @if($user->id === auth()->id())
                        {{-- El admin no puede cambiarse su propio rol --}}
                        <select class="form-select form-select-sm" disabled>
                            <option>{{ $user->role }}</option>
                        </select>
                        <small class="text-muted">Tu propio rol</small>
                    @else
                        <form action="{{ route('admin.users.updateRole', $user) }}"
                              method="POST"
                              class="d-flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="form-select form-select-sm">
                                @foreach(['admin', 'librarian', 'member'] as $role)
                                    <option value="{{ $role }}"
                                        {{ $user->role === $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Actualizar
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection