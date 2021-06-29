<?php

use App\Models\Brade;
use Illuminate\Support\Str;
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
            'slug' => Str::slug('cr7'),
            'description' => 'Marca registada pelo jogador de futebol, Cristiano Ronaldo, um dos melhores do mundo.',
        ]);
        Brade::create([
            'name' => 'GLX',
            'slug' => Str::slug('glx'),
            'description' => 'Marca registada pelo cantor angolano Dji Tafinha',
        ]);
        Brade::create([
            'name' => 'Gucci',
            'slug' => Str::slug('gucci'),
            'description' => 'Show your style',
        ]);
        Brade::create([
            'name' => 'Jordan',
            'slug' => Str::slug('jordan'),
            'description' => 'Living High.',
        ]);
        Brade::create([
            'name' => 'Nike',
            'slug' => Str::slug('nike'),
            'description' => 'Just Do It.',
        ]);
    }
}
