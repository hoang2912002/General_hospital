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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('body');
            $table->string('thumbnail');
            $table->timestamps('date_time');
            $table->unsignedInteger('categories_id')->nullable();
            $table->string('staff_uuid');
            $table->boolean('is_featured');
            $table->boolean('active');
            $table->int('views')->nullable();
            $table->int('likes')->nullable();
            $table->timestamps();
            $table->foreign('staff_uuid')->references('uuid')->on('users');
            $table->foreign('categories_id')->references('id')->on('news_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
