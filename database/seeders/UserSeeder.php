<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'last_name' => 'admin',
            'email' => 'admin@dgc.ga',
            'phone' => '074010203',
            'password' => bcrypt('12345678'),
            'user_type_id' => 1,
        ]);
    }
}
