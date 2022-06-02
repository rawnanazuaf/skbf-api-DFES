<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciationRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciation_rates', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type');
            $table->string('wilayah');
            $table->string('type');
            $table->string('code');
            $table->string('from');
            $table->string('to');
            $table->double('first_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depreciation_rates');
    }
}
