<?php

namespace App\Http\Controllers;

use App\Services\CityNovaPoshtaService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JsonException;

class CityController extends Controller
{
    protected CityNovaPoshtaService $service;

    public function __construct()
    {
        $this->service = app(CityNovaPoshtaService::class);
    }

    /**
     * ONLY for denug!!!
     * @return mixed
     */
    public function getByApi():mixed
    {
        return $this->service->getByApi();
    }

    /**
     * Get data from API Nova Poshta
     *
     * @param CityNovaPoshtaService $cities
     *
     * @return array
     * @throws JsonException
     */
    public function getFilterByApi():array
    {
        return $this->service->filterByApi();
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
