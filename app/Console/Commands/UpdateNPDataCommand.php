<?php

namespace App\Console\Commands;

use App\Services\CityNovaPoshtaService;
use App\Services\WarehouseNovaPoshtaService;
use Illuminate\Console\Command;

class UpdateNPDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-np-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add to db cities and warehouses from api novaposhta';

    /**
     * @param WarehouseNovaPoshtaService $warehouseService
     * @param CityNovaPoshtaService      $cityService
     *
     * @return void
     */
    public function handle(WarehouseNovaPoshtaService $warehouseService, CityNovaPoshtaService $cityService):void
    {
        $citiesApi = $cityService->getByApi();

        if ($citiesApi->isNotEmpty()) {
            $citiesFiltered = $cityService->filtered($citiesApi);
            $cityService->addToDB($citiesFiltered);
        }

        $citiesDB = $cityService->getFromDB();
        $warehouses = $warehouseService->getByApi();

        if ($warehouses->isNotEmpty() && $citiesDB->isNotEmpty()) {
            $warehousesFiltered = $warehouseService->filtered($warehouses, $citiesDB);
            $warehouseService->addToDB($warehousesFiltered);
        }
    }
}
