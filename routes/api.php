<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\CategoriaRelacionamentoController;
use App\Http\Controllers\VendaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('produtos', ProdutoController::class);

Route::apiResource('categorias', CategoriaProdutoController::class);

Route::apiResource('vendas', VendaController::class);

Route::apiResource('categoriasRelacionamentos', CategoriaRelacionamentoController::class);