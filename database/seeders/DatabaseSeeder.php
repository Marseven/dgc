<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@dgc.ga',
            'password' => bcrypt('12345678'),
        ]);

        Activity::create([
            "name" => 'Import/Export'
        ]);

        Activity::create([
            "name" => 'Commerce'
        ]);

        Activity::create([
            "name" => 'Logisitque'
        ]);
    }
}
