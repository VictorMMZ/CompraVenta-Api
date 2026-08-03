<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id')
                ?? User::factory()->create(['role' => 'trabajador'])->id,
            'seller_id' => Seller::query()->inRandomOrder()->value('id')
                ?? SellerFactory::new()->create()->id,
            'total' => fake()->randomFloat(2, 30, 3500),
            'payment_method' => fake()->randomElement(['efectivo', 'tarjeta', 'transferencia', 'bizum']),
            'notes' => fake()->boolean(30) ? fake()->sentence() : null,
        ];
    }
}
