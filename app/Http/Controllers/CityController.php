<?php

namespace App\Http\Controllers;

use App\Http\Services\CityService;
use JsonException;

class CityController extends Controller
{
    protected CityService $service;

    public function __construct()
    {
        $this->service = app(CityService::class);
    }

    /**
     * Get data for select
     *
     * @return mixed
     */
    public function getListFromDB(): mixed
    {
        return $this->service->getListFromDB();
    }

    /**
     * Get data from API Nova Poshta
     *
     * @throws JsonException
     */
    public function getDataFromApiNP():array
    {
        return $this->service->getDataFromApiNP();
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
