<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classe;
use App\Models\Material;
use App\Models\Role;
use App\Models\Studio;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UsertypeSeeder::class,
            StudioSeeder::class,
            ClasseSeeder::class,
            MaterialSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserRoleSeeder::class,
            ImageClassSeeder::class,
            ImageStudioSeeder::class,
        ]);
    }
}
