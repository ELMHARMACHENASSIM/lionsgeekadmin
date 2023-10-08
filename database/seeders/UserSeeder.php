<?php

namespace Database\Seeders;

use Database\Seeders\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create the first user admin mehdi bouziane
        $user = User::create([
            "name" => "Mahdi Bouziane",
            "email" => "admin@admin.com",
            "email_verified_at" => "2023-09-12 20:19:27",
            "password" => Hash::make("adminadmin"),
            "usertype_id" => 2,
            'password_changed' => 1,
        ]);

        // Get the roles you want to assign to the user
        $rolesToAssign = ['admin', 'gestionnaire_classe', 'gestionnaire_studio'];

        // Find the roles in the database
        $roles = Role::whereIn('name', $rolesToAssign)->get();

        // Extract the role IDs from the role models
        $roleIds = $roles->pluck('id')->toArray();

        // Attach the selected roles to the user using role IDs
        $user->roles()->attach($roleIds);
    }
}