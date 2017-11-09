<?php

use Illuminate\Database\Seeder;

class EventBuyerTableSeeder extends Seeder
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
        DB::table('event_buyers')->insert([ //,
        'event_id' => 1,
        'buyer_id' => 1,
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 2,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 3,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 4,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 5,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 6,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 7,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 8,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 9,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);
        DB::table('event_buyers')->insert([ //,
            'event_id' => 1,
            'buyer_id' => 10,
            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
        ]);

    }
}
