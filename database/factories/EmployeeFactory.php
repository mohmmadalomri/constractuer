<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> $this->faker->randomNumber(1,20),
            'company_id'=> $this->faker->randomNumber(1,20),
            'profession_id'=> $this->faker->randomNumber(1,20),
            'hourly_salary'=> $this->faker->randomNumber(),
            'monthly_salary'=> $this->faker->randomNumber(),
        ];
    }
}
