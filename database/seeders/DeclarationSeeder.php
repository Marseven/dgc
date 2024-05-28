<?php

namespace Database\Seeders;

use App\Models\DeclarationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeclarationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DeclarationType::create([
            'name' => 'Mensuelle',
        ]);
        DeclarationType::create([
            'name' => 'Trimestrielle',
        ]);
        DeclarationType::create([
            'name' => 'Semestrielle',
        ]);
        DeclarationType::create([
            'name' => 'Annuelle',
        ]);
    }
}
