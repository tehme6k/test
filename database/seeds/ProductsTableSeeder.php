<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Beta Alanine',
            'category_id' => 1,
            'created_by' => 3
        ]);

        Product::create([
            'name' => 'Red Dye',
            'category_id' => 1,
            'created_by' => 2
        ]);
        Product::create([
            'name' => 'Red 9 CC Scoops',
            'category_id' => 3,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Vitamin c',
            'category_id' => 1,
            'created_by' => 2
        ]);

        Product::create([
            'name' => '19 Oz Black Bottle',
            'category_id' =>4,
            'created_by' => 1
        ]);

        Product::create([
            'name' => '19 Oz Black Lid',
            'category_id' => 2,
            'created_by' => 1
        ]);
    }
}
