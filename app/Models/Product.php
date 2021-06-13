<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function collaborator_stock()
    {
        return $this->belongsToMany(Collaborator::class, 'stocks', 'product_id', 'collaborator_id')->withPivot('qty');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brade()
    {
        return $this->belongsTo(Brade::class);
    }
    public function style()
    {
        return $this->belongsTo(Style::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    protected $fillable = [
        'name',
        'category_id',
        'brade_id',
        'style_id',
        'size',
        'price',
        'descount',
        'collaborator_id',
        'sale_id',
        'condition_id',
        'description',
        'specification',
    ];

    /* Pegar toda a 1ª ocorrência */
    public function get_first_occurence(array $arr)
    {
        foreach ($arr as $key => $value) {
            return $key;
        }
        return NULL;
    }

    /* Agrupar produtos com suas respectivas fotos (por ID produto)*/
    public function productsGroupByID($dados)
    {

        $main = [];
        foreach ($dados as $dado) {
            $aux = [];
            foreach ($dados as $copy) {
                if ($dado->id == $copy->id) {
                    /* Adicionar todas as fotos pertencente ao mesmo produto (Mesmo ID)*/
                    array_push($aux, $copy->photo);
                }
            }

            $stocks = Stock::where('product_id', $dado->id )->get();
            $aux_collabs = [];
            foreach ($stocks as $stock){
                array_push($aux_collabs, Collaborator::where('id', $stock->collaborator_id)->first()->name);
            }

            $product = [
                'id' => $dado->id,
                'name' => $dado->name,
                'category_id' => $dado->category_id,
                'brade_id' => $dado->brade_id,
                'style_id' => $dado->style_id,
                'size' => $dado->size,
                'price' => $dado->price,
                'descount' => $dado->descount,
                'collaborators' => $aux_collabs,
                'sale_id' => $dado->sale_id,
                'condition_id' => $dado->condition_id,
                'description' => $dado->description,
                'specification' => $dado->specification,
                'active' => $dado->active,
                'photo' => $aux, // Adicionar todas as fotos salvas 
            ];
            array_push($main, $product);
        }

        $products = array();

        if (count($main) == 0) {
            return $products;
        }

        do {
            $first_element = $main[$this->get_first_occurence($main)];

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
