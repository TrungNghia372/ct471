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
        Schema::create('room', function (Blueprint $table) {
            $table->bigIncrements('room_id');
            $table->integer('room_number');
            $table->string('room_name');
            $table->integer('capacity');
            $table->string('convenient');
            $table->enum('status', ['Đang trống', 'Đang sử dụng', 'Đã đặt trước', 'Bảo trì', 'Đang dọn dẹp']);
            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->references('room_type_id')->on('roomtype');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
