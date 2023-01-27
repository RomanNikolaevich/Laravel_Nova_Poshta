<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('SettlementRef')->unique(); //code of warehous
            $table->string('Description'); //Description of warehous (ukr)
            $table->string('DescriptionRu'); //Description of warehous (rus)
            $table->timestamps();

            $table->index('SettlementRef'); //Adding a basic index
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
};
