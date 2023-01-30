<?php

namespace App\Http\Controllers;

use App\Http\Services\WarehouseService;
use JsonException;

class WarehouseController extends Controller
{
    protected WarehouseService $service;

    public function __construct()
    {
        $this->service = app(WarehouseService::class);
    }

    public function getListFromDB()
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
     * @throws JsonException
     */
    public function storeDataInDatabase()
    {
        return $this->service->storeDataInDatabase();
    }
}
