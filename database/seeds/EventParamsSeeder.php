<?php

use Illuminate\Database\Seeder;
use App\EventParam;

class EventParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event_params = array(
            [
                'id' => 1,
                'start_time' => '07:30:00',
                'end_time' => '08:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'start_time' => '08:30:00',
                'end_time' => '09:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'start_time' => '09:30:00',
                'end_time' => '10:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 4,
                'start_time' => '10:30:00',
                'end_time' => '11:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 5,
                'start_time' => '11:30:00',
                'end_time' => '12:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 6,
                'start_time' => '12:30:00',
                'end_time' => '13:30:00',
                'event_id' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
        );

        EventParam::insert($event_params);
    }
}
