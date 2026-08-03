<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'document_id' => fake()->unique()->bothify('DOC########'),
            'phone' => fake()->boolean(85) ? fake()->unique()->numberBetween(600000000, 799999999) : null,
            'notes' => fake()->boolean(35) ? fake()->sentence() : null,
        ];
    }
}
