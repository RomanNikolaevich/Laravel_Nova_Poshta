<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('city_ref'); //code of warehous
            $table->string('description'); //Description of warehous (ukr)
            $table->string('description_ru'); //Description of warehous (rus)
            $table->timestamps();

            $table->index('city_ref'); //Adding a basic index
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
};
