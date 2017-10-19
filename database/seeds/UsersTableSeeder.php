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
                'created_at' => \Carbon\Carbon::now()
            ],
        );

        User::insert($users);
    }
}
