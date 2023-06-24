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



Route::prefix('pedidos')->group(function () {
    Route::get('','PedidoController@listAll');
    Route::post('','PedidoController@create');
    Route::put('/{id}','PedidoController@update');
    Route::delete('delete/{id}','PedidoController@delete');
    Route::get('search','PedidoController@search');
});

Route::prefix('produtos')->group(function () {
    Route::get('','ProdutoController@listAll');
    Route::get('/{id}','ProdutoController@listProduto');
    Route::post('','ProdutoController@create');
    Route::put('/{id}','ProdutoController@update');
    Route::delete('delete/{id}','ProdutoController@delete');
    Route::get('search','ProdutoController@search');
});

Route::prefix('pedido_produtos')->group(function () {
    Route::get('/{id}','PedidoProdutosController@listAll');
    Route::post('','PedidoProdutosController@create');
    Route::put('/{id}','PedidoProdutosController@update');
    Route::delete('delete/{id}','PedidoProdutosController@delete');
    Route::get('search','PedidoProdutosController@search');
});
