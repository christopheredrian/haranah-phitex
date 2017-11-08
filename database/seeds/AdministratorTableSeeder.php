<?php

use App\Administrator;
use Illuminate\Database\Seeder;

class AdministratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrators = array(
            [
                'user_id' => '2',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'user_id' => '3',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        );
        /*$faker = Faker\Factory::create();
        $limit = 150;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('administrators')->insert([ //,
                'user_id' => $faker->numberBetween(0, 100),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }*/
    Administrator::insert($administrators);
    }
}