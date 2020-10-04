<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Starters',
                'image'=> 'cakes.png',
                'display_order'=> 1
            ],
            [
                'name' => 'Desert',
                'image'=> 'desert.png',
                'display_order'=> 2
            ],
            [
                'name' => 'Fruits',
                'image'=> 'fruits.png',
                'display_order'=> 3
            ]
        ]);
    }
}
