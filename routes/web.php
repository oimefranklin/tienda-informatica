<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductoController::class, 'index'])
    ->name('productos.index');

Route::get('/productos/crear', [ProductoController::class, 'create'])
    ->name('productos.create');

Route::post('/productos', [ProductoController::class, 'store'])
    ->name('productos.store');



