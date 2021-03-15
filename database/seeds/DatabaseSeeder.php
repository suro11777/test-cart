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
        // $this->call(UserSeeder::class);
         $this->call(CategoryTableSeeder::class);
         $this->call(CharacteristicTableSeeder::class);
         $this->call(ProductTableSeeder::class);
         $this->call(CharacteristicProductTableSeeder::class);
    }
}
