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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_uuid');
            $table->string('reason');
            $table->string('weight');
            $table->string('height');
            $table->string('vessel');
            $table->string('blood_pressure');
            $table->double('temperature');
            $table->text('note');
            $table->string('disease');
            $table->uuid('doctor_uuid');
            $table->date('re_exam_date')->nullable();
            $table->integer('day_id');
            $table->unsignedInteger('shift_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();
            $table->timestamps();
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('doctor_uuid')->references('uuid')->on('users');
            $table->foreign('user_uuid')->references('uuid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numbers');
    }
};
