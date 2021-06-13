<?php

use App\Models\Brade;
use Illuminate\Database\Seeder;

class BradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brade::create([
            'name' => 'CR7',
            'description' => 'Marca registada pelo jogador de futebol, Cristiano Ronaldo, um dos melhores do mundo.',
        ]);
        Brade::create([
            'name' => 'GLX',
            'description' => 'Marca registada pelo cantor angolano Dji Tafinha',
        ]);
        Brade::create([
            'name' => 'Gucci',
            'description' => 'Show your style',
        ]);
        Brade::create([
            'name' => 'Jordan',
            'description' => 'Living High.',
        ]);
        Brade::create([
            'name' => 'Nike',
            'description' => 'Just Do It.',
        ]);
    }
}
