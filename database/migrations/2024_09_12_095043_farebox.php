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
        Schema::create('data_farebox', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'periode');
            $table->string(column: 'passenger_name');
            $table->string(column: 'nik_passport_no');
            $table->string(column: 'nationality');
            $table->string(column: 'order_no');
            $table->string(column: 'ticket_no');
            $table->string(column: 'ticketing_station');
            $table->string(column: 'bussiness_area');
            $table->string(column: 'office_no');
            $table->string(column: "window_no");
            $table->string(column:  "shift_no");
            $table->string(column: "operator_name");
            $table->string(column: "ticketing_time");
            $table->string(column: "departure_date");
            $table->string(column: "origin");
            $table->string(column: "purchase_date");
            $table->string(column: "purchase_time");
            $table->string(column: "departure_time");
            $table->string(column: "destination");
            $table->string(column: "destination_code");
            $table->string(column: 'arrival_date');
            $table->string(column: 'arrival_time');
            $table->string(column: 'seat_class');
            $table->string(column: 'ticket_type');
            $table->integer(column: 'original_ticket_price');
            $table->string(column: 'discount_type');
            $table->integer(column: 'discount_rate');
            $table->integer(column: 'before_tax_price');
            $table->integer(column: 'tax_rate');
            $table->integer(column: 'after_tax_price');
            $table->string(column: 'plat_trade_no');
            $table->string(column: 'payment_gateway');
            $table->string(column: 'b2b_partner');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_farebox');
    }
};
