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
        Schema::create('services_result', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_uuid');
            $table->unsignedInteger('shift_id');
            $table->unsignedInteger('day_id');
            $table->unsignedInteger('service_id');
            $table->double('price');
            $table->string('result_file_path');
            $table->string('result_file_name');
            $table->text('note');
            $table->timestamps();
            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_result');
    }
};
