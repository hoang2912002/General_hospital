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
        Schema::create('numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->unsignedInteger('room_id');
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->boolean('gender')->nullable(true);
            $table->date('dob')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('expires_at')->nullable(true);
            $table->string('patient_identification_code');
            $table->boolean('status');
            $table->boolean('booking')->nullable(true);
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms');
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
