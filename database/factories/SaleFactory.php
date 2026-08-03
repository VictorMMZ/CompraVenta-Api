<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerId = DB::table('customers')->inRandomOrder()->value('id');

        return [
            'customer_id' => fake()->boolean(70) ? $customerId : null,
            'user_id' => User::query()->inRandomOrder()->value('id')
                ?? User::factory()->create(['role' => 'trabajador'])->id,
            'total' => fake()->randomFloat(2, 30, 4500),
            'payment_method' => fake()->randomElement(['efectivo', 'tarjeta', 'transferencia', 'bizum']),
            'notes' => fake()->boolean(25) ? fake()->sentence() : null,
            'sale_date' => fake()->date('Y-m-d'),
        ];
    }
}
