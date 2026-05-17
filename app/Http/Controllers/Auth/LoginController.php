<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            // Regenerar el ID de sesión para prevenir session fixation
            $request->session()->regenerate();
            return redirect()->intended(route('books.index'))
                ->with('success', '¡Bienvenido de nuevo, ' . Auth::user()->name . '!');
        }
        return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros
registros.'])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        // Invalidar la sesión actual y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }
}
