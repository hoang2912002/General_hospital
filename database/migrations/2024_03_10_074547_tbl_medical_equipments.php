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
        Schema::create('medical_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->boolean('status');
            $table->unsignedInteger('equipment_category_id');
            $table->date('production_date');
            $table->date('exp_date');
            $table->integer('quantity');
            $table->text('note');
            $table->timestamps();
            $table->foreign('equipment_category_id')->references('id')->on('equipment_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_equipments');
    }
};
