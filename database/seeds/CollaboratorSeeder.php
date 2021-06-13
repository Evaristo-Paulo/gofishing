<?php

use App\Models\Collaborator;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collaborator::create([
            'name' => 'Nike',
            'description' => 'Empresa produtora de vestuários e calçados desportivos.',
        ]);
        Collaborator::create([
            'name' => 'Jordan',
            'description' => 'Empresa produtora de vestuários e calçados desportivos.',
        ]);
        Collaborator::create([
            'name' => 'Elias Focus',
            'description' => 'Empreendedor freelancer de roupas e calçados desportivos.',
        ]);
        Collaborator::create([
            'name' => 'GLX',
            'description' => 'Empresa produtora de vestuários e calçados.',
        ]);
        Collaborator::create([
            'name' => 'Lufuaquenda Tomás',
            'description' => 'Empreendedor freelancer produtor de vestuários femininos.',
        ]);
    }
}
