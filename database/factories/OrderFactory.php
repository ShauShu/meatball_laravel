<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
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
        $User_ids = User::all()->pluck('id');
        return [
            "rname" => $this->faker->name,
            "rphone" => $this->faker->phoneNumber,
            "raddress" => $this->faker->address,
            "pay" => $this->faker->creditCardType,
            "state" => "order status",
            "User_id" => $this->faker->randomElement($User_ids)
        ];
    }
}
