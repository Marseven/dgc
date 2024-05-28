<?php

namespace Database\Seeders;

use App\Models\Logistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Logistic::create([
            'name' => 'Terrestre',
        ]);
        Logistic::create([
            'name' => 'Aérien',
        ]);
        Logistic::create([
            'name' => 'Ferroviaire',
        ]);
        Logistic::create([
            'name' => 'Maritime',
        ]);
        Logistic::create([
            'name' => 'Fluvial',
        ]);
    }
}
