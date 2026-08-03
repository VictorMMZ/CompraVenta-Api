<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Database\Factories\PurchaseDetailFactory;
use Illuminate\Database\Seeder;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseDetailFactory::new()->count(260)->create();

        Purchase::query()->each(function (Purchase $purchase): void {
            $total = (float) $purchase->purchaseDetails()->sum('subtotal');
            $purchase->update(['total' => $total]);
        });
    }
}
