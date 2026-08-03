<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          $categories = [
    'Electrónica',
    'Ropa',
    'Hogar',
    'Juguetes',
    'Deportes',
    'Libros',
    'Música',
    'Videojuegos',
    'Salud y Belleza',
    'Automotriz',
];

$category = fake()->randomElement($categories);

return [
    'name' => $category,
];
    }
}
