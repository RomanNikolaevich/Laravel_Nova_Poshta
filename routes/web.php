<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

//Route::match(['get', 'post'], 'index', [
//    'cities' => 'CityService@getListFromDB',
//    'warehouses' => 'WarehouseService@getListFromDB',
//]);

Route::get('/', [CityController::class, 'getCitiesFromDB'])->name('cities');
Route::get('city-get', [CityController::class, 'getByApi'])->name('city.get-list');
Route::get('city-filtered', [CityController::class, 'getFilterByApi'])->name('city.get-filtered');
Route::get('city-store', [CityController::class, 'addToDatabase'])->name('city.store-data-in-database');

Route::get('warehouses', [WarehouseController::class, 'getFromDatabase'])->name('warehouses');
Route::get('warehouses-get', [WarehouseController::class, 'getByApi'])->name('warehouses.get');
Route::get('warehouses-store', [WarehouseController::class, 'addToDatabase'])->name('warehouses.store-data-in-database');
