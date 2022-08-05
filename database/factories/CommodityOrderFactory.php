<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commodity;
use App\Models\Order;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\model=CommodityOrder>
 */
class CommodityOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Commodity_ids = Commodity::all()->pluck('id');
        $Order_ids = Order::all()->pluck('id');
        return [
            //
            "price" => $this->faker->numberBetween(50,500),
            "count" => $this->faker->numberBetween(1,10),
            "Commodity_id" => $this->faker->randomElement($Commodity_ids),
            "Order_id" => $this->faker->randomElement($Order_ids)
        ];
    }
}
