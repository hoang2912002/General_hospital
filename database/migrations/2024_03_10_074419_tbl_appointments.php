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
            $table->uuid('user_uuid');
            $table->string('name');
            $table->string('email');
            $table->uuid('doctor_uuid')->nullable(true);
            $table->boolean('status');
            $table->text('note');
            $table->integer('day_id');
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
