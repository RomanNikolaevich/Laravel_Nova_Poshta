<?php

namespace App\Http\Controllers;

use App\Http\Services\CityServiceNovaPoshta;
use App\Models\City;
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
     * Get data for select
     *
     * @return Application|Factory|View
     */
    public function getListFromDB(): Application|Factory|View
    {
        $cities = City::get();
        return view('index', ['cities'=>$cities]);
        //return $this->service->getListFromDB();
    }

    /**
     * Get data from API Nova Poshta
     *
     * @throws JsonException
     */
    public function getDataFromApiNP()
    {
        return $this->service->filterDataFromApi();
    }

    /**
     * Store data in database
     *
     * @throws JsonException
     */
    public function storeDataInDatabase()
    {
        return $this->service->storeDataInDatabase();
    }
}
