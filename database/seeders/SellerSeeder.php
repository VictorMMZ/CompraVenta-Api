<?php

namespace Database\Seeders;

use Database\Factories\SellerFactory;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SellerFactory::new()->count(25)->create();
    }
}
