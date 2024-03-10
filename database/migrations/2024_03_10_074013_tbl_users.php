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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->boolean('gender');
            $table->date('dob');
            $table->unsignedInteger('login_id');
            $table->timestamps();
            $table->foreign('login_id')->references('id')->on('logins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
