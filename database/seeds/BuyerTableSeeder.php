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
        $all_buyers_in_users = User::all()
            ->where('role', '=', 'buyer');
        $counter = 1;
        foreach ($all_buyers_in_users as $user){
            $new_buyer = new Buyer();
            $new_buyer->id = $counter;
            $new_buyer->phone = "1234567890";
            $new_buyer->user_id = $user->id;
//            $new_buyer->  event_id = 1;
            $new_buyer->country = $faker->country;
            $new_buyer->company_name = $faker->company;
            $new_buyer->company_address = $faker->address;
            $new_buyer->event_rep1 = $faker->name;
            $new_buyer->event_rep2 = $faker->name;
            $new_buyer->designation = $faker->country;
            $new_buyer->website = $faker->url;
            $new_buyer->save();
            $counter = $counter + 1;
        }

    }
}