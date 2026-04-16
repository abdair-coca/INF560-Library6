<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 
        'member_id', 
        'loaned_by',
        'loan_date', 
        'due_date', 
        'returned_date',
        'status', 
        'notes',
    ];
 
    protected $casts = [
        'loan_date'     => 'date',
        'due_date'      => 'date',
        'returned_date' => 'date',
    ];
 
    public function getIsOverdueAttribute(): bool
    {
        return $this->returned_date === null
            && $this->due_date->lt(now());
    }
 
    public function getDaysRemainingAttribute(): int
    {
        if ($this->returned_date !== null) {
            return 0;
        }
 
        return (int) $this->due_date->diffInDays(
            now(), false
        );
    }
}
