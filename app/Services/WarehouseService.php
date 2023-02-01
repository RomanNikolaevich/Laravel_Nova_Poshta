<?php

namespace App\Services;

use App\Http\Controllers\CityController;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use JsonException;

class WarehouseService
{
    /**
     * @return Application|Factory|View
     */
    public function getWarehousesFromDB():Application|Factory|View
    {
        return Warehouse::get();
    }

    /**
     * Get data from Api Niva Poshta
     * @throws JsonException
     */
    public function getDataFromApiNP():array
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_warehouse');

        $response = Http::post($url, $data);

        //Get all warehouses
        $warehouses = json_decode($response, true, 512, JSON_THROW_ON_ERROR)["data"];//array
        $cities = app(CityController::class)->getCitiesFromDB();

        $cities = $cities['cities']->toArray();

        $filtered_warehouses = [];
        foreach ($warehouses as $warehouse) {
            foreach ($cities as $city) {
                if ($city['ref'] === $warehouse['CityRef']) {
                    $filtered_warehouses[] = $warehouse;
                }
            }
        }

        return $filtered_warehouses;
    }

    /**
     * Store data in database
     *
     * @return void
     * @throws JsonException
     */
    public function storeDataInDatabase():void
    {
        foreach ($this->getDataFromApiNP() as $warehouse) {
            Warehouse::create([
                'city_ref'       => $warehouse['CityRef'],
                'description'    => $warehouse['Description'],
                'description_ru' => $warehouse['DescriptionRu'],
            ]);
        }
    }
}
