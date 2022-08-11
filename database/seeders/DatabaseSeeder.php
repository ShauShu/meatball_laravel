<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Commodity;
use App\Models\CommodityUser;
use App\Models\CommodityOrder;
use App\Models\Comm_change;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->count(20)->create();
        Order::factory()->count(50)->create();
        Commodity::factory()->count(30)->create();
        CommodityUser::factory()->count(60)->create();
        CommodityOrder::factory()->count(120)->create();
        Comm_change::factory()->count(120)->create();
        $CommodityOrder_ids = CommodityOrder::all();
        foreach ($CommodityOrder_ids as $key=>$item) {
            $count = $item->count;
            Comm_change::updateOrCreate(['CommodityOrder_id' => $key+1,"Commodity_id" => null,"count" => $count]);
        }
        $admin = [
        "name"=>"admin",
        "account"=>"admin",
        "address"=>"nuknown",
        "phone"=>"nuknown",
        "email"=>"admin@example.com",
        "password"=>bcrypt('1234'),
        "admin"=>true
        ];
        User::create($admin);
    }
}