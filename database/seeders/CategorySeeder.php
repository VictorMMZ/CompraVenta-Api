<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

foreach ($categories as $category) {
    Category::create([
        'name' => $category,
    ]);
}
    }
}
