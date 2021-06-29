<?php

use App\Models\Category;
use Illuminate\Support\Str;
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
            'slug' => Str::slug('calcados'),
            'description' => 'Categoria de calçados',
        ]);
        Category::create([
            'name' => 'Roupas Femininas',
            'slug' => Str::slug('roupas-femininas'),
            'description' => 'Categoria de roupas femininas',
        ]);
        Category::create([
            'name' => 'Roupas Masculinas',
            'slug' => Str::slug('roupas-masculinas'),
            'description' => 'Categoria de roupas masculinas',
        ]);
        Category::create([
            'name' => 'Casacos',
            'slug' => Str::slug('casacos'),
            'description' => 'Categoria de casacos',
        ]);
    }
}
