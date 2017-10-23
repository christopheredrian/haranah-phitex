<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
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
            DB::table('events')->insert([ //,
                'id' => $faker->numberBetween(0, 100),
                'event_name' => $faker->randomElement(['Tour Package', 'Auction', 'Discountable Packages']),
                'timestamp' =>  $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
    }


}