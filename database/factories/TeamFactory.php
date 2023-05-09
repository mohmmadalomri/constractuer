<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'describe'=>$this->faker->sentence(),
            'image'=>$this->faker->image(null, 640, 480),
            'supervisor_id'=>2,
            'company_id'=>1,
        ];
    }
}
