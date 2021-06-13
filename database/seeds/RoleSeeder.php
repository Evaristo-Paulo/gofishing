<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'type' => 'admin',
            'description' => 'Previlégio total do painel de controle'
         ]);
         Role::create([
            'type' => 'manager',
            'description' => 'Previlégio parcial do sistema'
         ]);
         Role::create([
            'type' => 'user',
            'description' => 'Previlégio reduzido do painel de controle'
         ]);
         Role::create([
            'type' => 'client',
            'description' => 'Previlégio apenas no site/ecommerce'
         ]);
         
    }
}
