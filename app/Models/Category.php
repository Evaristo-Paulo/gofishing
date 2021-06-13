<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /* Agrupar produtos com suas respectivas fotos (por ID produto)*/
    public function categoriesGroupByID($dados)
    {

        $main = [];
        $aux = Category::where('active', 1)->get();

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
                'cover' => $dado->cover,
                'description' => $dado->description,
                'qty' => $qty,
            ];
            array_push($main, $product);
        }

        $products = array();

        if (count($main) == 0) {
            return $products;
        }


        $function = new Product();
        do {
            $first_element = $main[$function->get_first_occurence($main)];

            foreach ($main as $key => $dado) {
                if ($first_element != null) {
                    if ($first_element['id'] == $dado['id']) {
                        unset($main[$key]);
                    }
                }
            }
            Array_push($products, $first_element);
        } while (count($main) > 0);

        return $products;
    }
}
