<?php

use Illuminate\Database\Seeder;

class EventSellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $limit = 150;
        //for ($i = 0; $i < $limit; $i++) {
        DB::table('event_sellers')->insert([ //,
        'event_id' => 1,
        'seller_id' => 1,
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_sellers')->insert([ //,
            'event_id' => 1,
            'seller_id' => 2,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_sellers')->insert([ //,
            'event_id' => 1,
            'seller_id' => 3,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_sellers')->insert([ //,
            'event_id' => 1,
            'seller_id' => 4,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_sellers')->insert([ //,
            'event_id' => 1,
            'seller_id' => 5,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        //}
    }
}
