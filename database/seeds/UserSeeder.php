<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'people_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        User::create([
            'people_id' => 2,
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager')
        ]);

        User::create([
            'people_id' => 3,
            'email' => 'user@gmail.com',
            'password' => Hash::make('user')
        ]);
    }
}
