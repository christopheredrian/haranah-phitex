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
                'phone' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '6',
                'phone' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '8',
                'phone' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '10',
                'phone' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
       /* $faker = Faker\Factory::create();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('sellers')->insert([ //,
                'user_id' => $faker->unique()->numberBetween(0, 15),
                'phone' => $faker->numberBetween(900000000,9999999999),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }*/
       );
        Seller::insert($sellers);
    }
}
