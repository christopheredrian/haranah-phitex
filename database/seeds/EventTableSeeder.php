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
                'event_name' => $faker->randomElement(['Tour Package', 'Auction', 'Discountable Packages']),
                'event_place' => $faker->randomElement(['BAGUIO', 'TUBA', 'MANILA']),
                'event_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }


    }
}