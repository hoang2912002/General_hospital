<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('prescription_id');
            $table->unsignedInteger('service_result_id');
            $table->double('price');
            $table->timestamps();
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->foreign('service_result_id')->references('id')->on('services_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
