<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('consultation_id')->index();
            $table->string('application_id')->nullable();
            $table->string('contract_id')->nullable();
            $table->string('sales_id');
            $table->string('customer_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('director_name')->nullable();
            $table->string('shareholders')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('sales_name')->nullable();
            $table->string('produk')->nullable();
            $table->string('brand')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->bigInteger('vehicle_price')->nullable();
            $table->bigInteger('loanAmt')->nullable();
            $table->string('unitsAmt')->nullable();
            $table->string('insurance')->nullable();
            $table->string('dpPercent')->nullable();
            $table->string('tenure')->nullable();
            $table->string('addm_addb')->nullable();
            $table->string('effectiveRate')->nullable();
            $table->string('telno')->nullable();
            $table->string('consultation_area')->default('Cikarang');
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('npwp')->nullable();
            $table->timestamp('consultation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('contract_tenure')->nullable();
            $table->timestamp('contract_starting_date')->nullable();
            $table->timestamp('contract_termination_date')->nullable();
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
        Schema::dropIfExists('consultations');
    }
}
