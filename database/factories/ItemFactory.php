<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
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
            'type' => $this->faker->title(),
            'describe' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'image' => $this->faker->image(null, 640, 480),
            'company_id' => $this->faker->randomNumber(1,20),



        ];
    }
}
