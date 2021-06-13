<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products (){
        return $this->belongsToMany(Product::class, 'order_products','order_id' ,'product_id');
    }
}