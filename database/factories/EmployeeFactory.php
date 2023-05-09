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
            'user_id'=> 1,
            'company_id'=> 1,
            'profession_id'=> 1,
            'hourly_salary'=> 0,
            'monthly_salary'=> 0,
        ];
    }
}
