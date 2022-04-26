<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status=[1,2,3];
        return [
            'name' => $this->faker->sentence(rand(1, 4)),
            'category_id' => $this->faker->numberBetween(1, 15),
            'status' => $status[rand(0,2)]
        ];
    }
}
