<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableBloodBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blood_banks', function (Blueprint $table) {
            $table->dropForeign(['blood_group_id']);
            $table->dropColumn('blood_group_id');
            $table->string('blood_name');
            $table->integer('status');
            $table->boolean('is_new')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood_banks', function (Blueprint $table) {
            $table->unsignedBigInteger('blood_group_id')->after('id');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups')->onDelete('cascade');
            $table->dropColumn('blood_name');
            $table->dropColumn('status');
            $table->dropColumn('is_new');
        });
    }
}
