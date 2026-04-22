<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Novela',
                'color' => '#3B82F6',
                'description' => 'Obras de ficción narrativa'
            ],
            [
                'name' => 'Ciencia Ficción',
                'color' => '#8B5CF6',
                'description' => 'Ficción especulativa y futurista'
            ],
            [
                'name' => 'Historia',
                'color' => '#EF4444',
                'description' => 'Obras sobre eventos históricos'
            ],
            [
                'name' => 'Poesía',
                'color' => '#EC4899',
                'description' => 'Obras en verso y prosa poética'
            ],
            [
                'name' => 'Ciencia',
                'color' => '#10B981',
                'description' => 'Divulgación y textos científicos'
            ],
            [
                'name' => 'Tecnología',
                'color' => '#F59E0B',
                'description' => 'Computación, ingeniería y más'
            ],
            [
                'name' => 'Filosofía',
                'color' => '#6366F1',
                'description' => 'Pensamiento filosófico y ética'
            ],
            [
                'name' => 'Arte',
                'color' => '#F97316',
                'description' => 'Artes visuales, música, teatro'
            ],
            [
                'name' => 'Biografía',
                'color' => '#14B8A6',
                'description' => 'Biografías y autobiografías'
            ],
            [
                'name' => 'Infantil',
                'color' => '#A855F7',
                'description' => 'Literatura para niños y jóvenes'
            ],
        ];
        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
