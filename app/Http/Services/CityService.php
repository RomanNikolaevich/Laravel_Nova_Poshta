<?php

namespace App\Http\Services;

use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use JsonException;

class CityService
{
    /**
     * @return Application|Factory|View
     */
    public function getListFromDB(): Application|Factory|View
    {
        $cities = City::get();
        return view('index', ['cities'=>$cities]);
    }

    /**
     * Get data from Api Niva Poshta
     * @throws JsonException
     */
    public function getDataFromApiNP():array
    {
        $url = config('novaposhta.url');
        $data = config('novaposhta.data_city');
        $excluded_cities = config('novaposhta.excluded_cities');
        $number_of_cities = config('novaposhta.number_of_cities');
        $cities_total_length = count($excluded_cities)+$number_of_cities;

        $response = Http::post($url, $data);

        //Get all cities
        $cities = json_decode($response, true, 512, JSON_THROW_ON_ERROR)["data"];

        // Add only the first 20 cities
        $cities = array_slice($cities, 0, $cities_total_length);

        // Exclude certain cities
        $filtered_cities = [];
        foreach ($cities as $city) {
            if (!in_array($city["DescriptionRu"], $excluded_cities, true)) {
                // Add data to filtered cities array
                $filtered_cities[] = $city;
            }
        }

        return $filtered_cities;
    }

    /**
     * Store data in database
     *
     * @return void
     * @throws JsonException
     */
    public function storeDataInDatabase():void
    {
        foreach ($this->getDataFromApiNP() as $city) {
            City::create([
                'ref'           => $city['Ref'],
                'description'   => $city['Description'],
                'description_ru' => $city['DescriptionRu'],
                'type'          => $city['SettlementTypeDescription'],
                'type_ru'        => $city['SettlementTypeDescriptionRu'],
            ]);
        }
    }
}
