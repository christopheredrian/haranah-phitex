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
                'first_name' => 'Chris',
                'last_name' => 'Espiritu',
                'email' => 'admin@haranah.com',
                'password' => bcrypt('admin'),
                'role' => ('admin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'first_name' => 'Anne',
                'last_name' => 'Zheng',
                'email' => 'annezheng@haranah.com',
                'password' => bcrypt('admin'),
                'role' => ('admin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 4,
                'first_name' => 'Sean',
                'last_name' => 'Genove',
                'email' => 'seangenove@haranah.com',
                'password' => bcrypt('seller'),
                'role' => ('seller'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 5,
                'first_name' => 'Ling',
                'last_name' => 'Fama',
                'email' => 'lingfama@haranah.com',
                'password' => bcrypt('buyer'),
                'role' => ('buyer'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 6,
                'first_name' => 'Jay',
                'last_name' => 'Garcia',
                'email' => 'jaygarcia@haranah.com',
                'password' => bcrypt('seller'),
                'role' => ('seller'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 7,
                'first_name' => 'Dean',
                'last_name' => 'Donglawen',
                'email' => 'deanearl@haranah.com',
                'password' => bcrypt('buyer'),
                'role' => ('buyer'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 8,
                'first_name' => 'Jane',
                'last_name' => 'Zheng',
                'email' => 'janezheng@haranah.com',
                'password' => bcrypt('seller'),
                'role' => ('seller'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 9,
                'first_name' => 'Mark',
                'last_name' => 'Eslao',
                'email' => 'markeslao@haranah.com',
                'password' => bcrypt('buyer'),
                'role' => ('buyer'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
        );
        User::insert($users);
//        $faker = Faker\Factory::create();
//        $limit = 150;
//        for ($i = 0; $i < $limit; $i++) {
//            DB::table('users')->insert([ //,
//                'first_name' => $faker->firstName(),
//                'last_name' => $faker->lastName,
//                'email' => $faker->email,
//                'password' => bcrypt('random'),
//                'role' => $faker->randomElement(['buyer', 'seller']),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ]);
//        }
    }
}
