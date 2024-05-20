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
        Schema::create('number_medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number_id');
            $table->uuid('patient_uuid');
            $table->unsignedInteger('medical_record_id')->nullable();
            $table->timestamps();
            $table->foreign('number_id')->references('id')->on('numbers');
            $table->foreign('patient_uuid')->references('uuid')->on('users');
            $table->foreign('medical_record_id')->references('id')->on('medical_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_medical_records');
    }
};
