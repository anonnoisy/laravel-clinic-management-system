<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTypeBed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_bed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bed_id');
            $table->unsignedBigInteger('bed_type_id');
            $table->timestamps();
            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('cascade');
            $table->foreign('bed_type_id')->references('id')->on('bed_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_bed');
    }
}
