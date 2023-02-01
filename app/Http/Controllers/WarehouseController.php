<?php

namespace App\Http\Controllers;

use App\Services\WarehouseNovaPoshtaService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JsonException;

class WarehouseController extends Controller
{
    protected WarehouseNovaPoshtaService $service;

    public function __construct()
    {
        $this->service = app(WarehouseNovaPoshtaService::class);
    }

    /**
     * Get data from API Nova Poshta
     *
     * @throws JsonException
     */
    public function getByApi():array
    {
        return $this->service->getByApi();
    }

    /**
     * @throws JsonException
     */
    public function addToDatabase()
    {
        return $this->service->addToDatabase();
    }

    /**
     * @return Application|Factory|View
     */
    public function getFromDatabase():Application|Factory|View
    {
        $warehouses = $this->service->getFromDatabase();
        return view('index', ['warehouses'=>$warehouses]);
    }
}
