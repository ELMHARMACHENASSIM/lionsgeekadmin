<?php

namespace Database\Seeders;

use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Usertype::insert([
            [
                "user_type" => "User extern"
            ],
            [
                "user_type" => "User intern"
            ],
        ]);
    }
}
