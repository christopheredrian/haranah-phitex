<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(SellerTableSeeder::class);
//        $this->call(BuyerTableSeeder::class);
//        $this->call(AdministratorTableSeeder::class);
//        $this->call(SuperAdministratorTableSeeder::class);
//        $this->call(EventTableSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(SellerTableSeeder::class);
//        $this->call(BuyerTableSeeder::class);
//        $this->call(AdministratorTableSeeder::class);
//        $this->call(BuyerProfileTableSeeder::class);

    }
}
