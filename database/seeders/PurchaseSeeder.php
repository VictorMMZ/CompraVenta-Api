<?php

namespace Database\Seeders;

use Database\Factories\PurchaseFactory;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseFactory::new()->count(80)->create();
    }
}
