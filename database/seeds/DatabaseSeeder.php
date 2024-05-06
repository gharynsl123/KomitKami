<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstansiSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CostumerSeeder::class);
        $this->call(MarkomSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductsSedeer::class);
    }
}
