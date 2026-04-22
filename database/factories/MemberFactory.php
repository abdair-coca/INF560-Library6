<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;
    public function definition(): array
    {
        $type = fake()->randomElement([
            'standard',
            'premium',
            'student',
        ]);
        $maxLoans = match ($type) {
            'premium' => 7,
            'student' => 2,
            default => 3,
        };
        return [
            'user_id' => null, // Se asigna en el seeder
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'membership_type' => $type,
            'membership_expires_at' => fake()->dateTimeBetween(
                'now',
                '+1 year'
            ),
            'max_loans' => $maxLoans,
            'is_active' => true,
        ];
    }
}
