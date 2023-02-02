<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * ref - code of warehouse
     * city_ref - code city of warehouse, basic index
     * description - Description of warehouse (ukr)
     * description_ru - Description of warehouse (rus)
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->string('city_ref')->index();
            $table->string('description');
            $table->string('description_ru');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('warehouses');
    }
};
