<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'describe' => $this->faker->text(),
            'date' => $this->faker->date(),
            'total'=>$this->faker->randomNumber() ,
            'client_id' =>$this->faker->randomNumber(1,20),

        ];
    }
}
