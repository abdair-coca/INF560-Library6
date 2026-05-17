<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Evitar que el admin se cambie su propio rol
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        $request->validate([
            'role' => ['required', 'in:admin,librarian,member'],
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', "Rol de {$user->name} actualizado correctamente.");
    }
}