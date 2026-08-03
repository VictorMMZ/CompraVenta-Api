<?php

namespace Database\Seeders;

use App\Models\Sale;
use Database\Factories\SaleDetailFactory;
use Illuminate\Database\Seeder;

class SaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleDetailFactory::new()->count(260)->create();

        Sale::query()->each(function (Sale $sale): void {
            $total = (float) $sale->saleDetails()->sum('subtotal');
            $sale->update(['total' => $total]);
        });
    }
}
