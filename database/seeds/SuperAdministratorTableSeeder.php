<?php

use Illuminate\Database\Seeder;

class SuperAdministratorTableSeeder extends Seeder
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
            DB::table('super_administrators')->insert([ //,
                'user_id' => $faker->numberBetween(0, 100),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }


    }
}