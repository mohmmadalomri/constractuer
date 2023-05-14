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
            'budget'=> $this->faker->randomNumber(),
            'image'=> $this->faker->image(null, 640, 480),
            'supervisor_id'=> $this->faker->randomNumber(1,20),
            'start_time'=> $this->faker->date(),
            'end_time'=> $this->faker->date(),
            'client_id'=> $this->faker->randomNumber(1,20),
            'company_id'=>1
        ];
    }
}
