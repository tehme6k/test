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
         $this->call(UsersTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(InventoriesTableSeeder::class);
         $this->call(ProjectsSeeder::class);
         $this->call(TypesSeeder::class);
         $this->call(CountrySeeder::class);


    }
}
