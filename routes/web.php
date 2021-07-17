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

// E-COMMERCE
Route::get('/', 'StoreController@home')->name('store.home');
Route::prefix('/loja')->name('store.')->group(function(){
    Route::get('/logout', 'StoreController@logout')->name('logout');
    Route::post('/login', 'StoreController@loginStore')->name('login.store');
    Route::post('/fale-connosco', 'StoreController@contactUs')->name('contact.us');
    Route::post('/subscreve-na-newsletter', 'StoreController@newsLetter')->name('newsletter');
    Route::post('/registo-de-clente', 'StoreController@registerStore')->name('register.store.save');
    Route::get('/', 'StoreController@products')->name('products');
    Route::get('/produtos/{id}/detalhes', 'StoreController@productDetails')->name('product.details');
    Route::get('/', 'StoreController@products')->name('products');
    Route::get('/produtos/categorias/{slug}/filtro', 'StoreController@productFilterByCategory')->name('product.filter.by.category');
    Route::get('/produtos/marcas/{slug}/filtro', 'StoreController@productFilterByBrand')->name('product.filter.by.brand');
    Route::post('/produtos/pesquisa', 'StoreController@productFilterByName')->name('product.filter.by.name');
    Route::get('/produtos/carrinho', 'StoreController@cart')->name('cart');
    Route::get('/produtos/carrinho/{id}/remocao', 'StoreController@getRemoveItem')->name('cart.remove.item');
    Route::post('/produtos/carrinho/actualizacao', 'StoreController@cartUpdate')->name('cart.update.item');
    Route::post('/produtos/carrinho/novo-preco', 'StoreController@cartUpdatePrice')->name('cart.update.price.item');
    Route::get('/produtos/{id}/adiciona-no-carrinho', 'StoreController@getAddToCart')->name('cart.add');
    Route::get('/checkout', 'StoreController@checkout')->name('checkout');
    Route::post('/checkout', 'StoreController@confirmPayment')->name('checkout.post')->middleware('auth');
});

// PAINEL
Route::get('/login', 'PainelController@login')->name('login');
Route::prefix('/painel')->name('painel.')->group(function(){
    Route::get('/home', 'PainelController@home')->name('home')->middleware('auth');
    Route::post('/home', 'PainelController@home')->name('stats.activities')->middleware('auth');
    Route::get('/logout', 'PainelController@logout')->name('logout')->middleware('auth');
    Route::post('/login', 'PainelController@loginStore')->name('login.store');
    Route::get('/produtos/registo', 'PainelController@productRegister')->name('products.register')->middleware('auth');
    Route::post('/produtos/registo', 'PainelController@productRegisterStore')->name('products.register.store')->middleware('auth');
    Route::get('/produtos/{id}/actualizacao', 'PainelController@productUpdate')->name('products.update')->middleware('auth');
    Route::get('/produtos', 'PainelController@products')->name('products')->middleware('auth');
    Route::post('/produtos/actualizacao', 'PainelController@productUpdateSave')->name('products.update.save')->middleware('auth');
    Route::get('/produtos/{id}/remocao', 'PainelController@productRemove')->name('products.remove')->middleware('auth');

    Route::get('/pedidos', 'PainelController@orders')->name('orders')->middleware('auth');
    Route::get('/pedidos/{id}/visualizacao', 'PainelController@order')->name('order')->middleware('auth');
    Route::get('/pedidos/{id}/finalizado', 'PainelController@orderDone')->name('order.done')->middleware('auth');

    Route::get('/funcionarios/{id}/meu-perfil', 'PainelController@workerProfile')->name('workers.profile')->middleware('auth');
    Route::put('/funcionarios/{id}/alteracao-de-senha/meu-perfil', 'PainelController@workerProfileUpdatePasswordSave')->name('workers.profile.update.password.save')->middleware('auth');
    Route::put('/funcionarios/{id}/actualizacao/meu-perfil', 'PainelController@workerProfileUpdateSave')->name('workers.profile.update.save')->middleware('auth');
    Route::get('/funcionarios/registo', 'PainelController@workerRegister')->name('workers.register')->middleware('auth');
    Route::post('/funcionarios/registo', 'PainelController@workerRegisterStore')->name('workers.store')->middleware('auth');
    Route::get('/funcionarios/{id}/actualizacao', 'PainelController@workerUpdate')->name('workers.update')->middleware('auth');
    Route::post('/funcionarios/actualizacao', 'PainelController@workerUpdateSave')->name('workers.update.save')->middleware('auth');
    Route::get('/funcionarios', 'PainelController@workers')->name('workers')->middleware('auth');

    Route::get('/fornecedores', 'PainelController@collaborators')->name('collaborators')->middleware('auth');

    Route::get('/stock', 'PainelController@stock')->name('stock')->middleware('auth');
    Route::put('/stock/{id}/actualizacao', 'PainelController@stockUpdate')->name('stock.update')->middleware('auth');

    Route::get('/categorias', 'PainelController@categories')->name('categories')->middleware('auth');
    Route::post('/categorias/registo', 'PainelController@categoryRegisterStore')->name('categories.store')->middleware('auth');
    Route::put('/categorias/{id}/actualizacao', 'PainelController@categoryUpdateSave')->name('categories.update.save')->middleware('auth');
    Route::get('/categorias/{id}/remocao', 'PainelController@categoryRemove')->name('categories.remove')->middleware('auth');

    Route::post('/fornecedores/registo', 'PainelController@collaboratorRegisterStore')->name('collaborators.store')->middleware('auth');
    Route::get('/fornecedores/{id}/remocao', 'PainelController@collaboratorRemove')->name('collaborators.remove')->middleware('auth');
    Route::put('/fornecedores/{id}/actualizacao', 'PainelController@collaboratorUpdateSave')->name('collaborators.update.save')->middleware('auth');

    Route::post('/marcas/registo', 'PainelController@bradeRegisterStore')->name('brades.store')->middleware('auth');

    Route::get('/clientes', 'PainelController@clients')->name('clients');
    Route::get('/clientes/{id}/remocao', 'PainelController@clientRemove')->name('clients.remove')->middleware('auth');

    Route::get('/relatorios/lista-de-categorias', 'PainelController@categoryRepport')->name('categories.repport');
    Route::get('/relatorios/lista-de-clientes', 'PainelController@clientRepport')->name('clients.repport');
    Route::get('/relatorios/lista-de-fornecedores', 'PainelController@collaboratorRepport')->name('collaborators.repport');
    Route::get('/relatorios/lista-de-funcionarios', 'PainelController@workerRepport')->name('workers.repport');
    Route::get('/relatorios/lista-de-produtos', 'PainelController@productRepport')->name('products.repport');
    Route::get('/relatorios/lista-de-produtos-por-categoria', 'PainelController@productByCategoryRepport')->name('product.by.categories.repport');

    Route::get('/usuarios', 'PainelController@users')->name('users')->middleware('auth');
    Route::get('/usuarios/{id}/actualizacao', 'PainelController@userUpdate')->name('users.update')->middleware('auth');
    Route::get('/usuarios/{id}/remocao', 'PainelController@userRemove')->name('users.remove')->middleware('auth');
    Route::put('/usuarios/{id}/actualizacao', 'PainelController@userUpdateSave')->name('users.update.save')->middleware('auth');
});

