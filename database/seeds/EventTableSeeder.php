<?php

use App\Event;
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
        /*$events = array (
           [
             'event_name' => 'Auction',
             'event_place' => 'Manila',
             'event_date' => Carbon\Carbon::now(),
             'event_description' => 'Offering never been seen before antiques all over the Philippines. Rare unattainable products are also available!',
             'event_status' => 'Activated',
             'created_at' => \Carbon\Carbon::now(),
             'updated_at' => \Carbon\Carbon::now()
           ],
            [
                'event_name' => 'XXX Young Adult Convention',
                'event_place' => 'Baguio City',
                'event_date' => Carbon\Carbon::now(),
                'event_description' => 'Convention for young adults to get to know each other disregarding race and profession. Activities are offered to strengthen the bonds of friends you meet along the way.',
                'event_status' => 'Activated',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'event_name' => 'Educational Tour for IT Students',
                'event_place' => 'Manila',
                'event_date' => Carbon\Carbon::now(),
                'event_description' => 'An educational tour for IT students to get to know the environment they will be entering upon graduating from their colleges. Different IT companies in Manila will be visited and an educational seminar would also be conducted.',
                'event_status' => 'Activated',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'event_name' => 'YYY Arts Convention',
                'event_place' => 'Manila',
                'event_date' => Carbon\Carbon::now(),
                'event_description' => 'Rare artworks, discussions, and professionals gather world wide to this convention to get to know and buy artworks of their preferences. Enthusiasts are also allowed to join.',
                'event_status' => 'Activated',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],*/
        $faker = Faker\Factory::create();
        $limit = 150;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('events')->insert([ //,
                'event_name' => $faker->randomElement(['Tour Package', 'Auction', 'Discountable Packages']),
                'event_place' => $faker->randomElement(['BAGUIO', 'TUBA', 'MANILA']),
                'event_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'event_status' => $faker->randomElement(['Registration Open', 'Registration Closed']),
                'event_description' => $faker->text($maxNbChars = 500),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
//        Event::insert($events);
    }
}