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
            'link_facebook' => $this->faker->url(),
            'link_twitter' => $this->faker->url(),
            'link_youtube' => $this->faker->url(),
            'link_linkedin' => $this->faker->url(),
            'address_1' => $this->faker->address(),
            'address_2' => $this->faker->address(),
            'country' => $this->faker->country(),
            'governorate' => $this->faker->text(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'user_id' => 1,
        ];
    }
}
