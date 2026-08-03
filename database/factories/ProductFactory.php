<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            ['name' => 'iPhone 15 Pro', 'brand' => 'Apple', 'model' => 'A3102'],
            ['name' => 'Galaxy S25', 'brand' => 'Samsung', 'model' => 'SM-S931B'],
            ['name' => 'PlayStation 5', 'brand' => 'Sony', 'model' => 'CFI-2000'],
            ['name' => 'MacBook Air', 'brand' => 'Apple', 'model' => 'M3'],
            ['name' => 'Rolex Submariner', 'brand' => 'Rolex', 'model' => '126610LN'],
            ['name' => 'Canon EOS R8', 'brand' => 'Canon', 'model' => 'R8'],
            ['name' => 'iPad Air', 'brand' => 'Apple', 'model' => 'A2588'],
        ];

        $product = fake()->randomElement($products);

        return [
            'name' => $product['name'],
            'brand' => $product['brand'],
            'model' => $product['model'],
            'serial_number' => strtoupper(fake()->unique()->bothify('SN########')),
            'description' => fake()->sentence(12),
            'purchase_price' => $purchasePrice = fake()->randomFloat(2, 50, 5000),
            'sale_price' => $purchasePrice * 1.30,
            'price' => $purchasePrice * 1.30,
            'category_id' => fake()->numberBetween(1, 10),
            'stock' => fake()->numberBetween(0, 15),
        ];
    }
}
