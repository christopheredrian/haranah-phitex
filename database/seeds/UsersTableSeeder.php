<?php

use App\User;
use App\Buyer;
use App\Seller;
use Illuminate\Database\Seeder;
use Faker\Factory;

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
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => ('admin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'first_name' => 'Sean',
                'last_name' => 'Genove',
                'email' => 'admins@gmail.com',
                'password' => bcrypt('password'),
                'role' => ('admin'),
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ],
//            [
//                'id' => 4,
//                'first_name' => 'Anne',
//                'last_name' => 'Zheng',
//                'email' => 'annezheng@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('buyer'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 5,
//                'first_name' => 'Gian',
//                'last_name' => 'Genove',
//                'email' => 'giangenove@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('buyer'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 6,
//                'first_name' => 'Ling',
//                'last_name' => 'Fama',
//                'email' => 'lingfama@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('buyer'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 7,
//                'first_name' => 'Jay',
//                'last_name' => 'Garcia',
//                'email' => 'jaygarcia@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('buyer'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 8,
//                'first_name' => 'Dean',
//                'last_name' => 'Donglawen',
//                'email' => 'deanearl@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('seller'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 9,
//                'first_name' => 'Jane',
//                'last_name' => 'Zheng',
//                'email' => 'janezheng@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('seller'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 10,
//                'first_name' => 'Mark',
//                'last_name' => 'Eslao',
//                'email' => 'markeslao@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('seller'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
//            [
//                'id' => 11,
//                'first_name' => 'Jeric',
//                'last_name' => 'Aspuria',
//                'email' => 'jericaspuria@gmail.com',
//                'password' => bcrypt('password'),
//                'role' => ('seller'),
//                'activated' => 1,
//                'created_at' => \Carbon\Carbon::now()
//            ],
        );

        User::insert($users);
        $faker = Factory::create();

        // Faker for Buyers
        for ($i = 1; $i <= 30; $i++) {
            DB::table('users')->insert([
                'id' => ($i+3),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => "buyer".($i)."@gmail.com",
                'password' => bcrypt('password'),
                'role' => "buyer",
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Faker for Sellers
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'id' => ($i+33),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => "seller".($i)."@gmail.com",
                'password' => bcrypt('password'),
                'role' => "seller",
                'activated' => 1,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
