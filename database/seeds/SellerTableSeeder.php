<?php

use App\Seller;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert all SELLER users in buyers table
        $faker = Factory::create();
        $all_sellers = User::all()
            ->where('role', '=', 'seller');
        $counter = 1;
        foreach ($all_sellers as $seller){
            $new_seller = new Seller();
            $new_seller->id = $counter;
            $new_seller->phone = "1234567890";
            $new_seller->user_id = $seller->id;
            $new_seller->country = $faker->country;
            $new_seller->company_name = $faker->company;
            $new_seller->company_address = $faker->address;
            $new_seller->event_rep1 = $faker->name;
            $new_seller->event_rep2 = $faker->name;
            $new_seller->designation = $faker->country;
            $new_seller->products = $faker->name;
            $new_seller->website = $faker->url;
            $new_seller->save();
            $counter = $counter + 1;
        }
    }
}
