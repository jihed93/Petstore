<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_status =[1,2];
        \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'user_name' => 'Jihed',
            'first_name' => 'Jihed',
            'last_name' => 'Sassi',
            'email' => 'jihedsassi@gmail.com',
            'user_status'=> $user_status[rand(0,1)],
            'phone' => 78542314,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
        ]);
        $this->call(CategorySeeder::class);
        $pets = \App\Models\Pet::factory(50)->create();
        foreach ($pets as $pet) {
            \App\Models\Tag::factory(1)->create(['pet_id' => $pet->id]);
            \App\Models\PhotoUrl::factory(1)->create(['pet_id' => $pet->id]);
            \App\Models\Order::factory(1)->create(['pet_id' => $pet->id]);
        };
    }
}
