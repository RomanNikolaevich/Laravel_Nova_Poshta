<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

//Route::match(['get', 'post'], 'index', [
//    'cities' => 'CityService@getListFromDB',
//    'warehouses' => 'WarehouseService@getListFromDB',
//]);

Route::get('/', [CityController::class, 'getListFromDB'])->name('cities');
Route::get('city-get', [CityController::class, 'getDataFromApiNP'])->name('city.get-list');
Route::get('city-store', [CityController::class, 'storeDataInDatabase'])->name('city.store-data-in-database');

Route::get('warehouses', [WarehouseController::class, 'getListFromDB'])->name('warehouses');
Route::get('warehouses-get', [WarehouseController::class, 'getDataFromApiNP'])->name('warehouses.get');
Route::get('warehouses-store', [WarehouseController::class, 'storeDataInDatabase'])->name('warehouses.store-data-in-database');
