<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'id' => 1,
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@haranah.com',
                'password' => bcrypt('superadmin'),
                'role' => ('superadmin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'first_name' => 'Manager',
                'last_name' => 'One',
                'email' => 'admin@haranah.com',
                'password' => bcrypt('password'),
                'role' => ('admin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'first_name' => 'Buyer',
                'last_name' => 'One',
                'email' => 'buyer@haranah.com',
                'password' => bcrypt('password'),
                'role' => ('buyer'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            ['id' => 4,
                'first_name' => 'Seller',
                'last_name' => 'One',
                'email' => 'seller@haranah.com',
                'password' => bcrypt('password'),
                'role' => ('seller'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()]
        );

        User::insert($users);
        \App\Buyer::insert([[
            'id' => 1,
            'user_id' => 3,
            'phone' => '09995678',
            'created_at' => \Carbon\Carbon::now()
        ]]);

        \App\Seller::insert([[
            'id' => 1,
            'user_id' => 4,
            'phone' => '9765432',
            'created_at' => \Carbon\Carbon::now()
        ]]);
    }
}
