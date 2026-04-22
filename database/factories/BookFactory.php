<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;
    public function definition(): array
    {
        $totalCopies = fake()->numberBetween(1, 10);
        return [
            'title' => ucfirst(fake()->sentence(3)),
            'isbn' => fake()->isbn13(),
            'publisher' => fake()->company(),
            'publish_year' => fake()->numberBetween(1950, 2025),
            'pages' => fake()->numberBetween(80, 1200),
            'language' => fake()->randomElement([
                'Español',
                'Español',
                'Español',
                'Español',
                'Inglés',
            ]),
            'description' => fake()->paragraph(),
            'cover_url' => null,
            'total_copies' => $totalCopies,
            'available_copies' => $totalCopies,
            'status' => 'available',
            'category_id' => null, // Se asigna en el seeder
        ];
    }
}
