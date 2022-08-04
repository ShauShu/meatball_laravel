<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "rname" => $this->faker->name,
            "rphone" => $this->faker->phoneNumber,
            "raddress" => $this->faker->address,
            "pay" => $this->faker->creditCardType,
            "state" => "order status",
        ];
    }
}
