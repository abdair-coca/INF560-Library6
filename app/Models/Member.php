<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'member_code', 
        'phone', 
        'address',
        'membership_type', 
        'membership_expires_at',
        'max_loans', 'is_active'
    ];

        protected $casts = [
        'membership_expires_at' => 'date',
        'is_active'             => 'boolean',
        'max_loans'             => 'integer',
    ];
 
    protected static function boot(): void
    {
        parent::boot();
 
        static::creating(function (Member $member) {
            if (empty($member->member_code)) {
                $member->member_code = 'LIB-'
                    . date('Ymd') . '-'
                    . str_pad(
                        random_int(0, 9999), 4, '0', STR_PAD_LEFT
                    );
            }
        });
    }
 
    public function getIsMembershipActiveAttribute(): bool
    {
        return $this->is_active
            && ($this->membership_expires_at === null
                || $this->membership_expires_at->gte(now()));
    }
}
