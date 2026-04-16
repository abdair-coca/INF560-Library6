<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'isbn',
        'publisher',
        'publish_year',
        'pages',
        'language',
        'description',
        'cover_url',
        'total_copies',
        'available_copies',
        'status',
        'category_id'
    ];

    protected $casts = [
        'publish_year' => 'integer',
        'pages' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer'
    ];

    public function getIsAvailableAtrribute(): bool
    {
        return $this->available_copies > 0;
    }

    public function decrementCopies(): bool
    {
        if($this->available_copies <= 0){
            return false;
        }
        $this->decrement('available_copies');
        $this->refresh();
        if($this->available_copies === 0) {
            $this->update(['status' => 'unavailable']);
        }
        return true;
    }

    public function incrementCopies(): void
    {
        if($this->available_copies < $this->total_copies) {
            $this->increment('available_copies');
            $this->refresh();
            if($this->status !== 'available') {
                $this->update(['status' => 'available']);
            }
        }
    }
}
