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
        Schema::create('roomimage', function (Blueprint $table) {
            $table->bigIncrements('image_id');
            $table->string('image');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomimage');
    }
};
