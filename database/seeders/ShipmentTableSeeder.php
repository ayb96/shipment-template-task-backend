<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\Models\User::all()->each(function ($user) use ($faker){
            foreach (range(1, 5) as $i){
                \App\Models\Shipment::create([
                    'waybill'=>$faker->sentence,
                    'name'=>$faker->sentence,
                    'phone'=>$faker->sentence,
                    'user_id'=>$user->getKey(),
                ]);
            }
        });
    }
}
