<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    // Helpers de rol
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isLibrarian(): bool
    {
        return $this->role === 'librarian';
    }
    public function isMember(): bool
    {
        return $this->role === 'member';
    }
    public function hasRole(string $role): bool
    {
        return match ($role) {
            'admin' => $this->isAdmin(),
            'librarian' => $this->isAdmin() || $this->isLibrarian(),
            'member' => true,
            default => false,
        };
    }
    public function member()
    {
        return $this->hasOne(\App\Models\Member::class);
    }
}
