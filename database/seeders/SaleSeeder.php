<?php

namespace Database\Seeders;

use Database\Factories\SaleFactory;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleFactory::new()->count(80)->create();
    }
}
