<?php

namespace App\Http\Controllers;

use App\Services\CityServiceNovaPoshta;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JsonException;

class CityController extends Controller
{
    protected CityServiceNovaPoshta $service;

    public function __construct()
    {
        $this->service = app(CityServiceNovaPoshta::class);
    }

    /**
     * ONLY for denug!!!
     * @return mixed
     */
    public function getFromApi():mixed
    {
        return $this->service->getFromApi();
    }

    /**
     * Get data from API Nova Poshta
     *
     * @param CityServiceNovaPoshta $cities
     *
     * @return array
     * @throws JsonException
     */
    public function getFilteredDataFromApi():array
    {
        return $this->service->filterDataFromApi();
    }

    /**
     * Store data in database
     *
     * @throws JsonException
     */
    public function addToDatabase():void
    {
        $this->service->addToDatabase();
    }

    /**
     * Get data for select
     *
     * @return Application|Factory|View
     */
    public function getCitiesFromDB(): Application|Factory|View
    {
        $cities = $this->service->getCitiesFromDB();

        return view('index', ['cities'=>$cities]);
    }
}
