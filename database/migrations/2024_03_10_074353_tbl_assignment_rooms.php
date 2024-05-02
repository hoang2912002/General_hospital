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
            $table->unsignedInteger('assignment_day_id');
            $table->unsignedInteger('assignment_shift_id');
            $table->unsignedInteger('room_id');
            $table->timestamps();
            $table->foreign('assignment_day_id')->references('id')->on('assignment_days');
            $table->foreign('assignment_shift_id')->references('id')->on('assignment_shifts');
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
