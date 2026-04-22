<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'nationality',
        'birth_date',
        'biography',
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string 
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function books(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Book::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}
