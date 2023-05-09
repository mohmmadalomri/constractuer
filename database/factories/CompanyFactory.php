<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
            'logo' => $this->faker->image(null, 640, 480),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'link_website' => $this->faker->url(),
            'link_facebook' => $this->faker->freeEmail(),
            'link_twitter' => $this->faker->freeEmail(),
            'link_youtube' => $this->faker->freeEmail(),
            'link_linkedin' => $this->faker->freeEmail(),
            'address_1' => $this->faker->address(),
            'address_2' => $this->faker->address(),
            'country' => $this->faker->country(),
            'governorate' => $this->faker->state(),
            'city' => $this->faker->state(),
            'zip_code' => $this->faker->state(),
            'user_id' => 1,
        ];
    }
}
