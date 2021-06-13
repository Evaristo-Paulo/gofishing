<?php

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::create([
            'type' => 'Activa',
            'description' => 'Produto em promoção',
        ]);

        Sale::create([
            'type' => 'Desactiva',
            'description' => 'Produto não está em promoção',
        ]);
    }
}
