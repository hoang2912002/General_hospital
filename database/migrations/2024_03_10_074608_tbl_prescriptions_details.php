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
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('medicine_id');
            $table->unsignedInteger('prescription_id');
            $table->tinyInteger('amount_of_time');
            $table->unsignedInteger('shift_id');
            $table->tinyInteger('quantity');
            $table->double('price');
            $table->text('note');
            $table->timestamps();
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};
