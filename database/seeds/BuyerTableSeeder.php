<?php

use App\Buyer;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BuyerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert all BUYER users in buyers table
        $faker = Factory::create();
        $all_buyers = User::all()
            ->where('role', '=', 'buyer');
        foreach ($all_buyers as $buyer){
            $new_buyer = new Buyer();
            $new_buyer->phone = "1234567890";
            $new_buyer->user_id = $buyer->id;
            $new_buyer->country = $faker->country;
            $new_buyer->save();
        }

    }
}