<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SellerSeeder;
use Database\Seeders\PurchaseSeeder;
use Database\Seeders\PurchaseDetailSeeder;
use Database\Seeders\SaleSeeder;
use Database\Seeders\SaleDetailSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        UserSeeder::class,
        CategorySeeder::class,
        ProductSeeder::class,
        SellerSeeder::class,
        PurchaseSeeder::class,
        PurchaseDetailSeeder::class,
        SaleSeeder::class,
        SaleDetailSeeder::class,
    ]);

    
}
}
