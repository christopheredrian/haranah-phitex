<?php

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
        $faker = Faker\Factory::create();
        $limit = 150;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('sellers')->insert([ //,
                'id' => $faker->numberBetween(0, 100),
                'user_id' => $faker->numberBetween(0, 100),
                'timestamp' =>  $faker->date($format = 'Y-m-d', $max = 'now')
            ]);


}