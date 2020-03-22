<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->default('Hospital Management System');
            $table->string('system_title')->default('Hospital Management System');
            $table->string('office_address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('office_email')->nullable();
            $table->string('office_fax')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('purchase_code')->nullable();
            $table->string('currency')->nullable();
            $table->string('system_logo_url')->nullable();
            $table->string('twilio_phone')->nullable();
            $table->string('twilio_sid')->nullable();
            $table->string('twilio_token')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
