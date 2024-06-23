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
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_uuid')->nullable(true);
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->boolean('gender')->nullable(true);
            $table->date('dob')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('patient_identification_code')->nullable(true);
            $table->uuid('doctor_uuid')->nullable(true);
            $table->boolean('status');
            $table->text('note');
            $table->date('date');
            $table->unsignedInteger('shift_id');
            $table->timestamps();
            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->foreign('doctor_uuid')->references('uuid')->on('users');
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
