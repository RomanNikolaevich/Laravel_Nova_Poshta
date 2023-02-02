<?php

namespace App\Console\Commands;

use App\Http\Controllers\WarehouseController;
use Illuminate\Console\Command;

class AddWarehousesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:add-warehouses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add to db warehouses from api novaposhta';

    /**
     * @return void
     */
    public function handle():void
    {
        $warehouses = new WarehouseController();
        $warehouses->addToDB();
    }
}
