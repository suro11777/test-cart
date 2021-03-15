<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        factory(App\Models\Api\Category::class, 4)->create();
        for ($i = 1; $i <= 6; $i++){
            factory(App\Models\Api\Category::class, 1)->create([
                'parent_id' => rand(1,4),
                'level' => 2,
            ]);
        }
        for ($i = 1; $i <= 8; $i++) {
            factory(App\Models\Api\Category::class, 1)->create([
                'parent_id' => rand(5, 10),
                'level' => 3,
            ]);
        }
    }
}
