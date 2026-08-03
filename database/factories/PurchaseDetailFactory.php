<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchaseDetail>
 */
class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::query()->inRandomOrder()->first(['id', 'purchase_price']);

        if (! $product) {
            $product = Product::factory()->create();
        }

        $quantity = fake()->numberBetween(1, 8);
        $unitPrice = (float) ($product->purchase_price ?? fake()->randomFloat(2, 10, 400));

        return [
            'purchase_id' => Purchase::query()->inRandomOrder()->value('id')
                ?? PurchaseFactory::new()->create()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => round($quantity * $unitPrice, 2),
        ];
    }
}
