<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'describe' => $this->faker->title(),
            'image' => $this->faker->image(null, 50, 50),
            'company_id' => $this->faker->randomNumber(1, 20),


        ];
    }
}
