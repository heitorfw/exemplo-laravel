<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendedorController;



Route::get('/vendedores', [VendedorController::class, 'index'] );
Route::get('/vendedores/{vendedor}', [VendedorController::class, 'show']);
Route::post('/vendedores', [VendedorController::class, 'store']);
Route::patch('/vendedores/{vendedor}', [VendedorController::class, 'update']);
Route::delete('/vendedores/{vendedor}', [VendedorController::class, 'destroy']);
