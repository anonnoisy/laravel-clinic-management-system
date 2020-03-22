<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bed_allotments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bed_id');
            $table->unsignedBigInteger('patient_id');
            $table->dateTime('allotment_time');
            $table->dateTime('discharge_time')->nullable();
            $table->timestamps();

            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bed_allotments');
    }
}
