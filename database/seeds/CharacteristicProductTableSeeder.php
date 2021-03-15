<?php

use Illuminate\Database\Seeder;

class CharacteristicProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('characteristic_product')->delete();
        $data = [];
        $products = \App\Models\Api\Product::all(['id']);
        $characteristics = \App\Models\Api\Characteristic::all(['id']);
        foreach ($products as $product) {
            foreach ($characteristics as $characteristic) {

                $data[] = [
                   /* 'id' => 1,*/
                    'product_id' => $product->id,
                    'characteristic_id' => $characteristic->id,
                    'value' => rand(1,1900)
                ];
            }
        }
        \DB::table('characteristic_product')->insert(
            $data
        );

    }
}
