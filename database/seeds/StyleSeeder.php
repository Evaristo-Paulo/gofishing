<?php

use App\Models\Style;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Style::create([
            'type' => 'Masculino',
            'description' => 'Produto para homem',
        ]);
        Style::create([
            'type' => 'Feminino',
            'description' => 'Produto para mulher',
        ]);
        Style::create([
            'type' => 'Unisex',
            'description' => 'Produto para homem ou mulher',
        ]);
    }
}
