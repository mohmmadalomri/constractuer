<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
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
            'describe'=> $this->faker->sentence(),
            'budget'=> $this->faker->randomNumber(5, true),
            'image'=> $this->faker->image(null, 640, 480),
            'supervisor_id'=> $this->faker->unique()->randomDigit(),
            'start_time'=> $this->faker->time(),
            'end_time'=> $this->faker->time(),
            'client_id'=> $this->faker->unique()->randomDigit(),
            'company_id'=>1
        ];
    }
}
