<?php

namespace App\Services;

use App\Http\Controllers\CityController;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use JsonException;

class WarehouseNovaPoshtaService
{
    /**
     * Get data from Api Nova Poshta
     *
     * @throws JsonException
     */
    public function getByApi():array
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
    public function addToDatabase():void
    {
        foreach ($this->getByApi() as $warehouse) {
            Warehouse::create([
                'ref'            => $warehouse['Ref'],
                'city_ref'       => $warehouse['CityRef'],
                'description'    => $warehouse['Description'],
                'description_ru' => $warehouse['DescriptionRu'],
            ]);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function getFromDatabase():Application|Factory|View
    {
        return Warehouse::get();
    }
}
