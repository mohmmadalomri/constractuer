<?php

namespace Database\Factories;

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

            'first_name' => fack()->firstName(),
            'last_name' => fack()->lastName(),
            'name_company' => fack()->company(),
            'phone'=>fack()->phoneNumber() ,
            'email' =>fack()->image(null, 640, 480),
            'link_website' => fack()->url() ,
            'link_facebook'=> fack()->freeEmail() ,
            'link_twitter'=> fack()->freeEmail() ,
            'link_youtupe'=> fack()->freeEmail() ,
            'link_linkedin'=> fack()->freeEmail() ,
            'address_1'=>fack()->address(),
            'address_2'=>fack()->address(),
            'country' => fack()->country(),
            'governorate'=>fack()->governorate(),
            'city' => fack()->state(),
            'zip_code' =>fack()->postcode(),
            'company_id'=>1,
        ];
    }
}
