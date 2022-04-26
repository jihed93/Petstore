<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
            'pet_id' => $this->faker->numberBetween(1, 50),
            'quantity' => $this->faker->numberBetween(1, 3),
            'ship_date' => $this->faker->dateTimeBetween('1day', '1year')->format('Y-m-d H:i'),
            'status' => $status[rand(0,2)],
            'complete' => $this->faker->randomElement([true, false]),
        ];
    }
}
