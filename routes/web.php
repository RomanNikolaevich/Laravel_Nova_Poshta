<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

//Route::match(['get', 'post'], 'index', [
//    'cities' => 'CityService@getListFromDB',
//    'warehouses' => 'WarehouseService@getListFromDB',
//]);

Route::get('/', [CityController::class, 'getCitiesFromDB'])->name('cities');
Route::get('city-get', [CityController::class, 'getFromApi'])->name('city.get-list');
Route::get('city-filtered', [CityController::class, 'getFilteredDataFromApi'])->name('city.get-filtered');
Route::get('city-store', [CityController::class, 'addToDatabase'])->name('city.store-data-in-database');

Route::get('warehouses', [WarehouseController::class, 'getListFromDB'])->name('warehouses');
Route::get('warehouses-get', [WarehouseController::class, 'getDataFromApiNP'])->name('warehouses.get');
Route::get('warehouses-store', [WarehouseController::class, 'storeDataInDatabase'])->name('warehouses.store-data-in-database');
