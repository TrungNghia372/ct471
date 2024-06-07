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
        Schema::create('bookingdetail', function (Blueprint $table) {
            $table->bigIncrements('booking_detail_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('booking_id');
            $table->foreign('room_id')->references('room_id')->on('room');
            $table->foreign('booking_id')->references('booking_id')->on('booking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingdetail');
    }
};
