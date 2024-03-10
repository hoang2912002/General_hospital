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
        Schema::create('assignment_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assignment_id');
            $table->unsignedInteger('room_id');
            $table->timestamps();
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_rooms');
    }
};
