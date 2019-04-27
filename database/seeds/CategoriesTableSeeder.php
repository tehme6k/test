<?php

use App\Category;
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

            Category::create([
                'name' => 'Powder',
                'created_by' => 1
            ]);

            Category::create([
                'name' => 'Lids',
                'created_by' => 2
            ]);

            Category::create([
                'name' => 'Scoops',
                'created_by' => 3
            ]);

            Category::create([
                'name' => 'Bottles',
                'created_by' => 1
            ]);
        }

}
