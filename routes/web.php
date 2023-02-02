<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CityController::class, 'getFromDB'])->name('cities');
Route::get('city-get', [CityController::class, 'getByApi'])->name('city.get-list');
Route::get('city-store', [CityController::class, 'addToDB'])->name('city.store-data-in-database');

Route::get('warehouses', [WarehouseController::class, 'getFromDB'])->name('warehouses');
Route::get('warehouses-get', [WarehouseController::class, 'getByApi'])->name('warehouses.get');
Route::get('warehouses-store', [WarehouseController::class, 'addToDB'])
    ->name('warehouses.store-data-in-database');
