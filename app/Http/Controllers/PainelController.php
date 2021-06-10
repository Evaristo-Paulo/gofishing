<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function home (){
        return view('painel.home');
    }

    public function login (){
        return view('painel.login');
    }

    public function productRegister (){
        return view('painel.products.register');
    }

    public function workerProfile( $id ){
        return view('painel.workers.profile');
    }

    public function workerRegister (){
        return view('painel.workers.register');
    }

    public function products (){
        return view('painel.products.list');
    }

    public function productUpdate ( $id ){
        return view('painel.products.update');
    }

    public function workers (){
        return view('painel.workers.list');
    }

    public function workerUpdate ( $id ){
        return view('painel.workers.update');
    }

    public function collaborators (){
        return view('painel.collaborators.list');
    }

    public function categories (){
        return view('painel.categories.list');
    }

    public function users (){
        return view('painel.users.list');
    }

    public function userUpdate(){
        return view('painel.users.update');
    }

    public function stock (){
        return view('painel.stock.list');
    }

    public function clients (){
        return view('painel.clients.list');
    }

    
}
