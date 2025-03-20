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
        Schema::create('data_ticketsales', function (Blueprint $table) {
            $table->id('id_ticketsales');
            $table->integer('seq_no');
            $table->string('periode');
            $table->string('passenger_name');
            // $table->foreignId('bak')->constrained('dokumen_bak')->nullable()->default(null);
            $table->string('nik_passport_no');
            $table->integer('bak')->nullable();
            $table->string('nationality');
            $table->string('order_no');
            $table->string('ticket_no');
            // $table->string('ticketing_station');
            // $table->string('bussiness_area');
            // $table->string('office_no');
            // $table->string('window_no');
            // $table->string('shift_no');
            $table->string('operator_name');
            // $table->string('ticketing_time');
            $table->string('departure_date');
            // $table->string('train_no');
            $table->string('origin');
            // $table->string('cars_number');
            // $table->string('seat_number');
            // $table->string('origin_code');
            $table->string('purchase_date');
            // $table->time('purchase_time');
            $table->string('departure_time');
            $table->string('destination');
            // $table->string('destination_code');
            $table->date('arrival_date');
            $table->string('arrival_time');
            $table->string('seat_class');
            // $table->string('ticket_type');
            // $table->integer('original_ticket_price');
            // $table->string('discount_type');
            // $table->integer('discount_rate');
            // $table->integer('before_tax_price');
            // $table->decimal('tax_rate', 4, 2);
            $table->integer('after_tax_price');
            // $table->string('ticketing_channel');
            $table->string('payment_method');
            $table->string('trade_no')->nullable();
            $table->string('plat_trade_no')->nullable();
            // $table->string('payment_gateway')->nullable();
            // $table->string('b2b_partner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ticketsales');
    }
};
