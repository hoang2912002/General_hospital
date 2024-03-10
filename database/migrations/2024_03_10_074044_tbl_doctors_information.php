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
        Schema::create('doctors_information', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('doctor_uuid');
            $table->string('image',250);
            $table->text('description');
            $table->timestamps();
            $table->foreign('doctor_uuid')->references('uuid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_information');
    }
};
