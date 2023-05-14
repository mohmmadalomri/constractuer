<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
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
            'issued_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'payment' => $this->faker->title(),
            'message' => $this->faker->text(),
            'subtotal' => $this->faker->randomNumber(),
            'discount' =>$this->faker->randomNumber(),
            'type_discount' => $this->faker->title(),
            'tax_name' =>$this->faker->name(),
            'tax_describe' => $this->faker->name(),
            'tax_rate' => $this->faker->randomNumber(),
            'total' => $this->faker->randomNumber(),
            'company_id' => $this->faker->randomNumber(1, 20),

        ];
    }
}
