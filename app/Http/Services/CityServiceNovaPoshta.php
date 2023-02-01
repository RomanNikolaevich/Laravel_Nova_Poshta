<?php

namespace App\Http\Services;

use App\Models\City;
use Illuminate\Support\Facades\Http;
use JsonException;

class CityServiceNovaPoshta
{
    /**
     * Get data from Api Nova Poshta
     *
     * @throws JsonException
     */


    /**
     * Store data in database
     *
     * @param array $filtered_cities
     *
     * @return void
     */
    public function addToDatabase(array $filtered_cities):void
    {
        foreach ($filtered_cities as $city) {
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
     * @param mixed $cities
     *
     * @return void
     */
    public function filterDataFromApi(mixed $cities):void
    {
        $numberOfCities = config('novaposhta.number_of_cities');
        $excludedCities = config('novaposhta.excluded_cities');

        // Add only the first 20 cities
        $cities = array_slice($cities, 0, $numberOfCities);

        // Exclude certain cities
        $filteredCities = [];
        foreach ($cities as $city) {
            if (!in_array($city["DescriptionRu"], $excludedCities, true)) {
                // Add data to filtered cities array
                $filteredCities[] = $city;
            }
        }

        $this->addToDatabase($filteredCities);
    }

    private function getFromApi()
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_city');

        $response = Http::post($url, $data);

        //Get all cities (array)
        $cities = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)['data'];

        $this->filterDataFromApi($cities);

    }
}
