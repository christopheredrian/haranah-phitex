<?php

use App\Buyer_Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyerProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 50;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('buyer_profiles')->insert([ //,
                'user_id' => $faker->unique()->numberBetween(1, 100),
                'address' => $faker->address,
                'city' => $faker->city,
                'country' => $faker->country,
                'post_code' => $faker->postcode,
                'about_me' => $faker->text($maxNbChars = 300),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
        /*$buyer_profiles = array(
            [
                'user_id' => '3',
                'address' => '#1233 Caranglaan District',
                'city' => 'Dagupan City',
                'country' => 'Philippines',
                'post_code' => '2400',
                'about_me' => 'Yolo',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
        Buyer_Profile::insert($buyer_profiles);*/
    }
}
