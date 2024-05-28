<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Activity::create([
            'name' => 'Producteur',
            'type' => "stock",
        ]);
        Activity::create([
            'name' => 'Importateur',
            'type' => "stock",
        ]);
        Activity::create([
            'name' => 'Semi-Grossiste',
            'type' => "stock",
        ]);
        Activity::create([
            'name' => 'Grossiste',
            'type' => "stock",
        ]);
    }
}
