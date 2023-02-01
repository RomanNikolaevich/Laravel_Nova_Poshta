<?php

namespace App\Services;

use App\Http\Controllers\CityController;
use App\Models\City;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use JsonException;

class CityServiceNovaPoshta
{
    /**
     * Get data from Api Nova Poshta
     */
    public function getFromApi():Collection
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_city');

        //Get all cities (collection)
        return Http::post($url, $data)->collect('data');
    }

    /**
     * @param mixed $cities
     *
     * @return array
     * @throws JsonException
     */
    public function filterDataFromApi():array
    {
        $cities = app(CityController::class)->getFromApi();

        $numberOfCities = config('novaposhta.number_of_cities');
        $excludedCities = config('novaposhta.excluded_cities');

        // Add only the first 20 cities
        $limitCities = $cities->take($numberOfCities)->toArray();

        // Exclude certain cities
        $filteredCities = [];
        foreach ($limitCities as $city) {
            if (!in_array($city["DescriptionRu"], $excludedCities, true)) {
                // Add data to filtered cities array
                $filteredCities[] = $city;
            }
        }

        return $filteredCities;
    }

    /**
     * Store data in database
     *
     * @param array $cities
     *
     * @return void
     * @throws JsonException
     */
    public function addToDatabase():void
    {
        $cities = app(CityController::class)->getFilteredDataFromApi();

        foreach ($cities as $city) {
            City::create([
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
     * @return mixed
     */
    public function getCitiesFromDB():mixed
    {
        return City::get();
    }
}
