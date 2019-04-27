<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Powder',
            'created_by' => 1
        ]);

        Type::create([
            'name' => 'Capsule',
            'created_by' => 1
        ]);

        Type::create([
            'name' => 'Powder Bulk',
            'created_by' => 1
        ]);

        Type::create([
            'name' => 'Capsule Bulk',
            'created_by' => 1
        ]);
    }
}
