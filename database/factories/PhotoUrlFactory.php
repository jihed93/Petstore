<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "photo_url" =>
            $this->faker->image(storage_path('app/public/pets'), 160, 160, null, false)
        ];
    }
}
