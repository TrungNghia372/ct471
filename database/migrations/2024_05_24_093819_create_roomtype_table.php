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
        Schema::create('roomtype', function (Blueprint $table) {
            $table->bigIncrements('room_type_id');
            $table->string('room_type_name');
            $table->string('description');
            $table->integer('hourly_price');
            $table->integer('overnight_price');
            $table->integer('daily_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomtype');
    }
};
