<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SaleDetail>
 */
class SaleDetailFactory extends Factory
{
    protected $model = SaleDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::query()->inRandomOrder()->first(['id', 'sale_price']);

        if (! $product) {
            $product = Product::factory()->create();
        }

        $quantity = fake()->numberBetween(1, 6);
        $unitPrice = (float) ($product->sale_price ?? fake()->randomFloat(2, 15, 600));

        return [
            'sale_id' => Sale::query()->inRandomOrder()->value('id')
                ?? SaleFactory::new()->create()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => round($quantity * $unitPrice, 2),
        ];
    }
}
