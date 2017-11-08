<?php

use Illuminate\Database\Seeder;

class BuyerProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyer_profiles = array(
            [
                'user_id' => '3',
                'address' => '#1233 Caranglaan District',
                'city' => 'Dagupan City',
                'country' => 'Philippines',
                'post_code' => '2400',
                'about_me' => 'Yolo',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
