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
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_uuid');
            $table->unsignedInteger('medical_record_id');
            // $table->string('name')->nullable();
            // $table->string('phone_number')->nullable();
            $table->double('total_price')->nullable();
            // $table->unsignedInteger('payment_id')->nullable();
            // $table->unsignedInteger('transaction_id')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->foreign('user_uuid')->references('uuid')->on('users');
            // $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('medical_record_id')->references('id')->on('medical_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
