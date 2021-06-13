<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function products_stock()
    {
        return $this->belongsToMany(Product::class, 'stocks', 'collaborator_id', 'product_id')->withPivot('qty');
    }



    /* Agrupar produtos com suas respectivas fotos (por ID produto)*/
    public function collaboratorsGroupByID($dados)
    {

        $main = [];
        $aux = Collaborator::where('active', 1)->get();

        foreach ($aux as $dado) {
            $qty = 0;  // acúmulo de stock de cada produto 
            foreach ($dados as $copy) {
                if ($dado->id == $copy->id) {
                    /* Adicionar todos os fornecedores pertencente ao mesmo produto (Mesmo ID)*/
                    $qty += $copy->qty;
                }
            }

            $product = [
                'id' => $dado->id,
                'name' => $dado->name,
                'photo' => 'default.png',
                'description' => $dado->description,
                'qty' => $qty,
            ];
            array_push($main, $product);
        }

        return $main;
    }
}
