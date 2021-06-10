<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// E-COMMERCE
Route::get('/', 'StoreController@home')->name('store.home');
Route::prefix('/loja/produtos')->name('store.')->group(function(){
    Route::get('/', 'StoreController@products')->name('products');
    Route::get('/{id}/detalhes', 'StoreController@productDetails')->name('product.details');
    Route::get('/carrinho', 'StoreController@cart')->name('cart');
});

// PAINEL
Route::prefix('/painel')->name('painel.')->group(function(){
    Route::get('/home', 'PainelController@home')->name('home');
    Route::get('login', 'PainelController@login')->name('login');
    Route::get('/produtos/registo', 'PainelController@productRegister')->name('products.register');
    Route::get('/produtos/{id}/actualizacao', 'PainelController@productUpdate')->name('products.update');
    Route::get('/produtos', 'PainelController@products')->name('products');
    Route::get('/funcionarios/{id}/meu-perfil', 'PainelController@workerProfile')->name('workers.profile');
    Route::get('/funcionarios/registo', 'PainelController@workerRegister')->name('workers.register');
    Route::get('/funcionarios/{id}/actualizacao', 'PainelController@workerUpdate')->name('workers.update');
    Route::get('/funcionarios', 'PainelController@workers')->name('workers');
    Route::get('/fornecedores', 'PainelController@collaborators')->name('collaborators');
    Route::get('/stock', 'PainelController@stock')->name('stock');
    Route::get('/categorias', 'PainelController@categories')->name('categories');
    Route::get('/clientes', 'PainelController@clients')->name('clients');
    Route::get('/usuarios', 'PainelController@users')->name('users');
    Route::get('/usuarios/{id}/actualizacao', 'PainelController@userUpdate')->name('users.update');
});

