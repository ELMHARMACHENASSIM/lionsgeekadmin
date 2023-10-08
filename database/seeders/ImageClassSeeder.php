<?php

namespace Database\Seeders;

use App\Models\ImageClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageClass::insert(
            [
                [
                    "classe_id" => 1, //salle_1
                    "images" => 'imgsalle1-1.jpg'
                ],
                [
                    "classe_id" => 1, //salle_1
                    "images" => 'imgsalle1-2.jpg'
                ],
                [
                    "classe_id" => 1, //salle_1
                    "images" => 'imgsalle1-3.jpg'
                ],
                //////
                [
                    "classe_id" => 2, //salle_2
                    "images" => 'imgsalle2-1.jpg'
                ],
                [
                    "classe_id" => 2, //salle_2
                    "images" => 'imgsalle2-2.jpg'
                ],
                [
                    "classe_id" => 2, //salle_2
                    "images" => 'imgsalle2-3.jpg'
                ],
                [
                    "classe_id" => 3, //salle_2
                    "images" => 'imgsalle2-1.jpg'
                ],
                [
                    "classe_id" => 3, //salle_2
                    "images" => 'imgsalle2-2.jpg'
                ],
                [
                    "classe_id" => 3, //salle_2
                    "images" => 'imgsalle2-3.jpg'
                ],
                //////
                [
                    "classe_id" => 4, //salle_2
                    "images" => 'imgsalle2-1.jpg'
                ],
                [
                    "classe_id" => 4, //salle_2
                    "images" => 'imgsalle2-2.jpg'
                ],
                [
                    "classe_id" => 4, //salle_2
                    "images" => 'imgsalle2-3.jpg'
                ],
                //////
                [
                    "classe_id" => 5, //salle_2
                    "images" => 'imgsalle2-1.jpg'
                ],
                [
                    "classe_id" => 5, //salle_2
                    "images" => 'imgsalle2-2.jpg'
                ],
                [
                    "classe_id" => 5, //salle_2
                    "images" => 'imgsalle2-3.jpg'
                ],
                //////
                [
                    "classe_id" => 6, //salle_2
                    "images" => 'imgsalle2-1.jpg'
                ],
                [
                    "classe_id" => 6, //salle_2
                    "images" => 'imgsalle2-2.jpg'
                ],
                [
                    "classe_id" => 6, //salle_2
                    "images" => 'imgsalle2-3.jpg'
                ],
            ]
        );
    }
}
