<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commodity;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Comm_change>
 */
class Comm_changeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Commodity_ids = Commodity::all()->pluck('id');
        return [
            "count" => $this->faker->numberBetween(10,500),
            "Commodity_id" => $this->faker->randomElement($Commodity_ids),
            "CommodityOrder_id" => null
        ];
    }
}
