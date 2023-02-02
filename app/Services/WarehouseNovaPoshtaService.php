<?php

namespace App\Services;

use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class WarehouseNovaPoshtaService
{
    /**
     * Get data from Api Nova Poshta
     *
     * @return Collection
     */
    public function getByApi():Collection
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_warehouse');
        $key = config('novaposhta.api_key');

        $data[] = $key;

        return Http::post($url, $data)
            ->collect('data');
    }

    /**
     * @param Collection $warehouses
     * @param            $cities
     *
     * @return Collection
     */
    public function filtered(Collection $warehouses, $cities):Collection
    {
        return $warehouses->filter(function ($warehouse) use ($cities) {
            foreach ($cities as $city) {
                if ($city['ref'] === $warehouse['CityRef']) {
                    return true;
                }
            }

            return false;
        });
    }

    /**
     * Store data in database
     *
     * @param Collection $warehouses
     *
     * @return void
     *
     */
    public function addToDB(Collection $warehouses):void
    {
        foreach ($warehouses as $warehouse) {
            Warehouse::updateOrCreate([
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
    public function getFromDB():Application|Factory|View
    {
        return Warehouse::get();
    }
}
