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
        Schema::create('booking', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->date('booking_date');
            $table->integer('total_amount');
            $table->string('request')->nullable();
            $table->integer('pay')->nullable();
            $table->enum('status', ['Chờ xác nhận', 'Đã xác nhận', 'Đã nhận phòng', 'Đã thanh toán']);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customer');
            $table->foreign('employee_id')->references('employee_id')->on('employee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
