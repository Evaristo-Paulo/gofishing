<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Calçados',
            'description' => 'Categoria de calçados',
        ]);
        Category::create([
            'name' => 'Chapéus',
            'description' => 'Categoria de chapéus',
        ]);
        Category::create([
            'name' => 'Roupas Femininas',
            'description' => 'Categoria de roupas femininas',
        ]);
        Category::create([
            'name' => 'Roupas Masculinas',
            'description' => 'Categoria de roupas masculinas',
        ]);
        Category::create([
            'name' => 'Sapatos',
            'description' => 'Categoria de sapatos',
        ]);
    }
}
