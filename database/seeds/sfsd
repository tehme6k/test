<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'innovativetim06@gmail.com')->first();

        if(!$user)
        {
            $user1 = User::create([
                'name' => 'Tim T',
                'email' => 'innovativetim06@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]);

            $user2 = User::create([
                'name' => 'Deidre C',
                'email' => 'moshimoshi6k@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]);

            $user3 = User::create([
                'name' => 'Dan W',
                'email' => 'timmy6k@gmail.com',
                'role' => 'user',
                'password' => Hash::make('password')
            ]);
        }
    }
}
