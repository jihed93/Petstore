<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert(
            [
                [
                    "id" => 1,
                    "name" => "cat1"
                ],
                [
                    "id" => 2,
                    "name" => "cat2"
                ],
                [
                    "id" => 3,
                    "name" => "cat3"
                ],
                [
                    "id" => 4,
                    "name" => "cat4"
                ],
                [
                    "id" => 5,
                    "name" => "cat5"
                ],
                [
                    "id" => 6,
                    "name" => "cat6"
                ],
                [
                    "id" => 7,
                    "name" => "cat7"
                ],
                [
                    "id" => 8,
                    "name" => "cat8"
                ],
                [
                    "id" => 9,
                    "name" => "cat9"
                ],
                [
                    "id" => 10,
                    "name" => "cat10"
                ],
                [
                    "id" => 11,
                    "name" => "cat11"
                ],
                [
                    "id" => 12,
                    "name" => "cat12"
                ],
                [
                    "id" => 13,
                    "name" => "cat13"
                ],
                [
                    "id" => 14,
                    "name" => "cat14"
                ],
                [
                    "id" => 15,
                    "name" => "cat15"
                ]
            ]
        );
    }
}
