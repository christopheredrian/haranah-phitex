<?php

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
        $faker = Faker\Factory::create();
        $limit = 150;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('buyers')->insert([ //,
                'id' => $faker->numberBetween(0, 100),
                'user_id' => $faker->numberBetween(0, 100),
                'timestamp' =>  $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
    }


}