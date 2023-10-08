<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create roles and save them to the database
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'gestionnaire_studio']);
        Role::create(['name' => 'gestionnaire_classe']);
        // Role::create(['name' => 'user']);
        // Add more roles as needed

    }
}
