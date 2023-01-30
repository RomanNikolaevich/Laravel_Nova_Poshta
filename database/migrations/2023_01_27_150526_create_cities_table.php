<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique(); //city code
            $table->text('description'); // city name (ukr)
            $table->text('description_ru'); //city name (rus)
            $table->string('type'); //city/village(ukr)
            $table->string('type_ru'); //city/village(rus)
            $table->timestamps();

            $table->index('ref'); //Adding a basic index
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
