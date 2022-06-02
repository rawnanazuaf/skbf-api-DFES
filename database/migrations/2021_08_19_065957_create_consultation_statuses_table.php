<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('consultation_id')->index();
            $table->string('review_process')->index();
            $table->string('review_state')->nullable();
            $table->timestamp('review_date')->nullable();
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
        Schema::dropIfExists('consultation_statuses');
    }
}
