<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->randomNumber(1, 20),
            'title' => $this->faker->title(),
            'day' => $this->faker->date(),
            'start_time' => $this->faker->date(),
            'end_time' => $this->faker->date(),
            'team_id' => $this->faker->randomNumber(1, 20),
            'instruction' => $this->faker->text(),
            'company_id' => $this->faker->randomNumber(1, 20),

        ];
    }
}
