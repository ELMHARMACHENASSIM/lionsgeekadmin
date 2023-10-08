<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classe::insert([
            [
                
                "name" => "salle 1",
                "disponible" => true,
                "nombre_utilisation" => 0,


            ],
            [
                "name" => "salle 2",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "salle 3",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "salle 4",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "salle 5",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
            [
                "name" => "salle 6",
                "disponible" => true,
                "nombre_utilisation" => 0,

            ],
        ]);
    }
}
