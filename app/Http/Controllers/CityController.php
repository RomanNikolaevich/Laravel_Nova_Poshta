<?php

namespace App\Http\Controllers;

use App\Services\CityNovaPoshtaService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class CityController extends Controller
{
    protected CityNovaPoshtaService $service;

    public function __construct()
    {
        $this->service = app(CityNovaPoshtaService::class);
    }

    /**
     * ONLY for debug!!!
     * Get filtered cities from API Nova Poshta
     *
     * @return Collection
     */
    public function getByApi():Collection
    {
        return $this->service->filtered($this->service->getByApi());
    }

    /**
     * Store cities in database
     */
    public function addToDB():void
    {
        $cities = $this->service->getByApi();
        if ($cities) {
            $cities = $this->service->filtered($cities);
            $this->service->addToDB($cities);
        }
    }

    /**
     * Get data for joins
     *
     * @return Collection
     */
    public function getFromDB():Collection
    {
       return $this->service->getFromDB();
    }

    /**
     * Get data for select
     *
     * @return Application|Factory|View
     */
    public function getView():Application|Factory|View
    {
        $cities = $this->getFromDB();

        return view('index', ['cities' => $cities]);
    }
}
