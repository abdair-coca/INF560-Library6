<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // Crear usuario con contraseña hasheada
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'member', // rol por defecto
        ]);
        // Crear registro Member automáticamente
        Member::create([
            'user_id' => $user->id,
            'member_code' => self::generateCode(),
            'membership_type' => 'standard',
            'membership_expires_at' => now()->addYear(),
            'max_loans' => 3,
            'is_active' => true,
        ]);
        // Iniciar sesión automáticamente tras el registro
        Auth::login($user);
        return redirect()->route('books.index')
            ->with('success', '¡Bienvenido, ' . $user->name . '! Tu cuenta ha sido creada.');
    }
    // Genera un código único: LIB-YYYYMMDD-XXXX
    private static function generateCode(): string
    {
        do {
            $code = 'LIB-' . date('Ymd') . '-' . str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $code)->exists());
        return $code;
    }
}
