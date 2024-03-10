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
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->tinyInteger('quantity');
            $table->double('price');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('manufacturer_id');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('medicines_type');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
