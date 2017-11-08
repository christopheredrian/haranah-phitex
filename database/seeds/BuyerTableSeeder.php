<?php

use App\Buyer;
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
        $buyers = array(
            [
                'user_id' => '5',
                'phone' => '9555555555',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '7',
                'phone' => '9777777777',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '9',
                'phone' => '9999999999',
                'country' => 'Philippines',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        );
        Buyer::insert($buyers);
        $faker = Faker\Factory::create();
        $limit = 50;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('buyers')->insert([ //,
                'user_id' => $faker->numberBetween(10, 160),
                'phone' => $faker->numberBetween(9000000000, 9999999999),
                'country' => $faker->country,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}