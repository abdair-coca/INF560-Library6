<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nationalities = [
            'Bolivia',
            'Argentina',
            'Colombia',
            'México',
            'Perú',
            'Chile',
            'Ecuador',
            'Venezuela',
            'España',
            'Uruguay',
            'Paraguay',
            'Brasil',
        ];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'nationality' => fake()->randomElement($nationalities),
            'birth_date' => fake()->dateTimeBetween(
                '-100 years',
                '-20 years'
            ),
            'biography' => fake()->paragraphs(2, true),
        ];
    }
}
