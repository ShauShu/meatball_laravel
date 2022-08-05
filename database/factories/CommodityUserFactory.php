<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commodity;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=CommodityUser>
 */
class CommodityUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Commodity_ids = Commodity::all()->pluck('id');
        $User_ids = User::all()->pluck('id');
        return [            
            //
            "count" => $this->faker->numberBetween(1,10),
            "Commodity_id" => $this->faker->randomElement($Commodity_ids),
            "User_id" => $this->faker->randomElement($User_ids)
        ];
    }
}
