<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\Models\User::create([
            'name'=>'Hussein Ayoub',
            'email'=>'ayoub@hotmail.com',
            'password'=>bcrypt('123456'),
        ]);

        foreach (range(1, 10) as $i){
            \App\Models\User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>bcrypt("123456"),
            ]);
        }
    }
}
