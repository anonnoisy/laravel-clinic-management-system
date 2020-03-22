<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBloodGroupToBloodDonors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blood_donors', function (Blueprint $table) {
            $table->unsignedBigInteger('blood_group_id')->after('age');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood_donors', function (Blueprint $table) {
            $table->dropForeign(['blood_group_id']);
            $table->dropColumn('blood_group_id');
        });
    }
}
