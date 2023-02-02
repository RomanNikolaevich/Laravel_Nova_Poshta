<?php

namespace App\Http\Controllers;

use App\Services\WarehouseNovaPoshtaService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use JsonException;

class WarehouseController extends Controller
{
    protected WarehouseNovaPoshtaService $service;

    public function __construct()
    {
        $this->service = app(WarehouseNovaPoshtaService::class);
    }

    /**
     * ONLY for debug!!!
     * Get data from API Nova Poshta
     *
     * @return Collection
     */
    public function getByApi():Collection
    {
        return $this->service->getByApi();
    }

    /**
     * Store warehouses in database
     *
     * @throws JsonException
     */
    public function addToDB():void
    {
        $warehouses = $this->service->getByApi();
        $cities = app(CityController::class)->getFromDB();
        if ($warehouses) {
            $warehouses = $this->service->filtered($warehouses, $cities);
            $this->service->addToDB($warehouses);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function getFromDB():Application|Factory|View
    {
        $warehouses = $this->service->getFromDB();

        return view('index', ['warehouses' => $warehouses]);
    }
}
