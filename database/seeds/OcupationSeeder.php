<?php

use App\Models\Ocupation;
use Illuminate\Database\Seeder;

class OcupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ocupation::create([
            'type' => 'Administrativa',
        ]);
        Ocupation::create([
            'type' => 'Comercial',
        ]);
        Ocupation::create([
            'type' => 'Finança',
        ]);
        Ocupation::create([
            'type' => 'Logística',
        ]);
        Ocupation::create([
            'type' => 'Técnica',
        ]);
        Ocupation::create([
            'type' => 'Outros',
        ]);
    }
}
