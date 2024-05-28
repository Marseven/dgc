<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductType::create([
            'name' => 'Alimentaire',
        ]);
        ProductType::create([
            'name' => 'Pharmaceutique',
        ]);
        ProductType::create([
            'name' => 'Automobile',
        ]);
        ProductType::create([
            'name' => 'Electroménager',
        ]);
        ProductType::create([
            'name' => 'Librairie',
        ]);
    }
}
