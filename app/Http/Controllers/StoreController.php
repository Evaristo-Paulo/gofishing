<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home (){
        return view('store.welcome');
    }

    public function products (){
        return view('store.products');
    }

    public function productDetails (){
        return view('store.product-details');
    }

    public function cart (){
        return view('store.cart');
    }
}
