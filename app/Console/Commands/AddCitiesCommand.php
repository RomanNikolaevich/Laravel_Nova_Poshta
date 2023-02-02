<?php

namespace App\Console\Commands;

use App\Http\Controllers\CityController;
use Illuminate\Console\Command;

class AddCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:add-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add to db cities from api novaposhta';

    /**
     * @return void
     */
    public function handle():void
    {
        $cities = new CityController;
        $cities->addToDB();
    }
}
