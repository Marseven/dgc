<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::create([
            'name' => 'Admin',
            'description' => "Administrateur",
            'user_type_id' => 1,
        ]);

        // Assign the created role to user 1000001
        DB::table('user_roles')->insert([
            'user_id' => 1000001,
            'role_id' => $role->id, // Use the ID of the created role
        ]);

        // Execute the custom SQL query to insert role_privileges
        DB::statement("
            INSERT INTO role_privileges (privilege_id, role_id, user_type_id)
            SELECT id AS privilege_id, {$role->id} AS role_id, 1 AS user_type_id
            FROM privileges
        ");
    }
}
