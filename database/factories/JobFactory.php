<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->randomNumber(1,20),
            'title' => $this->faker->title(),
            'instruction' =>$this->faker->text(),
            'start_day'=>$this->faker->date() ,
            'end_day' =>$this->faker->date(),
            'start_time' =>$this->faker->date() ,
            'end_time'=> $this->faker->date() ,
            'subtotal'=>$this->faker->randomNumber() ,
            'arrival_window'=> $this->faker->text() ,
            'company_id'=> $this->faker->randomNumber(1,20) ,



        ];
    }
}
