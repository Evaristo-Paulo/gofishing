<?php

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'type' => 'Disponível',
            'description' => 'Produto disponível',
        ]);
        Condition::create([
            'type' => 'Indisponível',
            'description' => 'Produto indisponível',
        ]);
        
    }
}
