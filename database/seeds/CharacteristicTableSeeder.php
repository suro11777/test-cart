<?php

use Illuminate\Database\Seeder;

class CharacteristicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('characteristics')->delete();

        \DB::table('characteristics')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'length',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'width',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'weight',
                ),
        ));
    }
}
