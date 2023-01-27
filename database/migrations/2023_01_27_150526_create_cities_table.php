<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('Ref')->unique(); //city code
            $table->string('Description'); // city name (ukr)
            $table->string('DescriptionRu'); //city name (rus)
            $table->string('SettlementTypeDescription'); //city/village(ukr)
            $table->string('SettlementTypeDescriptionRu'); //city/village(rus)
            $table->timestamps();

            $table->index('Ref'); //Adding a basic index
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
