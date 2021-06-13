<?php

use App\Models\People;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        People::create([
            'name' => 'Evaristo Paulo',
            'phone' => '938709694',
            'bi' => '0123456789LA551',
            'adress' => 'Centralidade do Sequele, Cacuaco, Luanda',
            'birthday' => '22-11-1996',
            'ocupation_id' => 5,
            'gender_id' => 1,
        ]);

        People::create([
            'name' => 'Etelvina Catenda',
            'phone' => '940570688',
            'bi' => '0123456789LA552',
            'adress' => 'Kahio, Capetown, South Africa',
            'birthday' => '12-02-1995',
            'ocupation_id' => 3,
            'gender_id' => 2,
        ]);

        People::create([
            'name' => 'Daniel Canhamena',
            'phone' => '912345678',
            'bi' => '0123456789LA553',
            'adress' => '7 cunhas, Cacuaco, Luanda',
            'birthday' => '10-02-1993',
            'ocupation_id' => 5,
            'gender_id' => 1,
        ]);
    }
}
