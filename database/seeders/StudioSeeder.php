<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Studio::insert([
            [
                "name" => "Studio 1",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "Studio 2",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],

            [
                "name" => "Espace cafe",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "Espace Agora",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "Co working",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "Externe",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
        ]);
    }
}
