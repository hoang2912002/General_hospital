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
        Schema::create('test_requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('medical_record_id');
            $table->unsignedInteger('medical_record_id');
            $table->boolean('status')->nullable(true);
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('medical_record_id')->references('id')->on('medical_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_requisitions');
    }
};
