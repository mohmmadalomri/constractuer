<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'name_company' => $this->faker->userName(),
            'phone'=>$this->faker->phoneNumber() ,
            'email' =>$this->faker->freeEmail(),
            'link_website' => $this->faker->url() ,
            'link_facebook'=> $this->faker->url() ,
            'link_twitter'=> $this->faker->url() ,
            'link_youtupe'=> $this->faker->url() ,
            'link_linkedin'=> $this->faker->url() ,
            'address_1'=>$this->faker->text(),
            'address_2'=>$this->faker->address(),
            'country' => $this->faker->text(),
            'governorate'=>$this->faker->text(),
            'city' => $this->faker->text(),
            'zip_code' =>$this->faker->text(),
            'company_id'=>1,
        ];
    }
}
