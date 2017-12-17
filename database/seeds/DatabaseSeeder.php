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
        $this->call(UsersTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(SellerTableSeeder::class);
        $this->call(BuyerTableSeeder::class);
//        $this->call(EventBuyerTableSeeder::class);
//        $this->call(EventSellerTableSeeder::class);
        $this->call(AdministratorTableSeeder::class);
        $this->call(EventParamsSeeder::class);
    }
}
