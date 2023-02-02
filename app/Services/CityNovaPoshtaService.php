<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * Service for NovaPoshta 2.0 API
 */
class CityNovaPoshtaService
{
    /**
     * Get data from Api Nova Poshta
     * Get all cities (collection)
     */
    public function getByApi():Collection
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_city');
        $key = config('novaposhta.api_key');

        $data[] = $key;

        return Http::post($url, $data)
            ->collect('data');
    }

    /**
     * Add only the first 20 cities
     * Exclude certain cities
     * Add data to filtered cities array
     *
     * @param Collection $cities
     *
     * @return Collection
     */
    public function filtered(Collection $cities):Collection
    {
        $numberOfCities = config('novaposhta.number_of_cities');
        $excludedCities = config('novaposhta.excluded_cities');

        return $cities
            ->take($numberOfCities)
            ->whereNotIn('DescriptionRu', $excludedCities);
    }

    /**
     * Store data in database
     *
     * @param Collection $cities
     *
     * @return void
     */
    public function addToDB(Collection $cities):void
    {
        foreach ($cities->toArray() as $city) {
            City::updateOrCreate([
                'ref'            => $city['Ref'],
                'description'    => $city['Description'],
                'description_ru' => $city['DescriptionRu'],
                'type'           => $city['SettlementTypeDescription'],
                'type_ru'        => $city['SettlementTypeDescriptionRu'],
            ]);
        }
    }

    /**
     * Get data from database
     *
     * @return Collection
     */
    public function getFromDB():Collection
    {
        return City::get();
    }
}
