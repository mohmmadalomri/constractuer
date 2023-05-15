<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
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
            'describe' => $this->faker->sentence(),
            'project_id' => $this->faker->randomNumber(1, 20),
            'team_id' => $this->faker->randomNumber(1, 20),
            'start_time' => $this->faker->date(),
            'end_time' => $this->faker->date(),
            'status' => $this->faker->title(),
            'location' => $this->faker->title(),

        ];
    }
}
