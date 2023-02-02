<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * ref - city code, basic index
     * description - city name (ukr),
     * description_ru - city name (rus),
     * type - city/village(ukr),
     * type_ru - city/village(rus),
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique()->index();
            $table->text('description');
            $table->text('description_ru');
            $table->string('type');
            $table->string('type_ru');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('cities');
    }
};
