<?php

namespace App\Http\Controllers;

use App\Services\WarehouseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JsonException;

class WarehouseController extends Controller
{
    protected WarehouseService $service;

    public function __construct()
    {
        $this->service = app(WarehouseService::class);
    }

    /**
     * @return Application|Factory|View
     */
    public function getListFromDB():Application|Factory|View
    {
        $warehouses = $this->service->getWarehousesFromDB();
        return view('index', ['warehouses'=>$warehouses]);
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
