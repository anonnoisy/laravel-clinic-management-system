<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentBedToBeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beds', function (Blueprint $table) {
            $table->unsignedBigInteger('bed_type_id')->after('bed_number');
            $table->integer('bed_currently')->after('total_bed')->nullable();
            $table->integer('bed_usage')->after('bed_currently')->nullable();

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
        Schema::table('beds', function (Blueprint $table) {
            $table->dropForeign(['bed_type_id']);
            $table->dropColumn('bed_type_id');
            $table->dropColumn('bed_currently');
            $table->dropColumn('bed_usage');
        });
    }
}
