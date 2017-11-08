<?php

use App\Seller;
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
        $sellers = array(
            [
                'user_id' => '4',
                'phone' => '9444444444',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '6',
                'phone' => '9666666666',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '8',
                'phone' => '9888888888',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
       );
        Seller::insert($sellers);
        $faker = Faker\Factory::create();
        $limit = 50;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('sellers')->insert([ //,
                'user_id' => $faker->unique()->numberBetween(10, 160),
                'phone' => $faker->numberBetween(900000000,9999999999),
                'country' => $faker->country,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}
