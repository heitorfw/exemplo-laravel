<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendedorController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ComissaoController;
Route::get('/vendedores', [VendedorController::class, 'index'] );
Route::get('/vendedores/{vendedor}', [VendedorController::class, 'show']);
Route::post('/vendedores', [VendedorController::class, 'store']);
Route::patch('/vendedores/{vendedor}', [VendedorController::class, 'update']);
Route::delete('/vendedores/{vendedor}', [VendedorController::class, 'destroy']);

Route::get('/contatos', [ContatoController::class, 'index']);
Route::get('/contatos/{contato}', [ContatoController::class, 'show']);
Route::post('/contatos', [ContatoController::class, 'store']);
Route::patch('/contatos/{contato}', [ContatoController::class, 'update']);
Route::delete('/contatos/{contato}', [ContatoController::class, 'destroy']);

Route::get('/comissoes', [ComissaoController::class, 'index']);
Route::get('/comissoes/{comissao}', [ComissaoController::class, 'show']);
Route::post('/comissoes', [ComissaoController::class, 'store']);
Route::patch('/comissoes/{comissao}', [ComissaoController::class, 'update']);
Route::delete('/comissoes/{comissao}', [ComissaoController::class, 'destroy']);





