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
        Schema::create('user_services', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_uuid');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('room_id');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_services');
    }
};
