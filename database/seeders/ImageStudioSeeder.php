<?php

namespace Database\Seeders;

use App\Models\ImageStudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageStudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageStudio::insert([
            [
                'studio_id' => 1,// studio
                'images' =>'st1.jpg',
            ],
            [
                'studio_id' => 1,// studio
                'images' =>'st2.jpg',
            ],
            [
                'studio_id' => 1,// studio
                'images' =>'st3.jpg',
            ],
            /////////
            [
                'studio_id' => 2,// studio2
                'images' =>'std2-1.jpg',
            ],
            [
                'studio_id' => 2,// studio2
                'images' =>'std2-2.jpg',
            ],
            [
                'studio_id' => 2,// studio2
                'images' =>'std2-3.jpg',
            ],
            ///////////////
            [
                'studio_id' => 3,// cafe
                'images' =>'cafe1.jpg',
            ],
            [
                'studio_id' => 3,// cafe
                'images' =>'cafe2.jpg',
            ],
            [
                'studio_id' => 3,// cafe
                'images' =>'cafe3.jpg',
            ],
            ///////////////
            [
                'studio_id' => 4,// agora
                'images' =>'agora1.jpg',
            ],
            [
                'studio_id' => 4,// agora
                'images' =>'agora2.jpg',
            ],
            [
                'studio_id' => 4,// agora
                'images' =>'agora3.jpg',
            ],
            [
                'studio_id' => 4,// agora
                'images' =>'agora4.jpg',
            ],
            ///////////////
            [
                'studio_id' => 5,// coworking
                'images' =>'coworkingimg1.jpg',
            ],
            [
                'studio_id' => 5,// coworking
                'images' =>'coworkingimg2.jpg',
            ],
            [
                'studio_id' => 5,// coworking
                'images' =>'coworkingimg3.jpg',
            ],
            ///////////////
            [
                'studio_id' => 6,// cafe
                'images' =>'cafe1.jpg',
            ],
            [
                'studio_id' => 6,// cafe
                'images' =>'cafe2.jpg',
            ],
            [
                'studio_id' => 6,// cafe
                'images' =>'cafe3.jpg',
            ],
            //////////////
       
        ]);
    }
}
