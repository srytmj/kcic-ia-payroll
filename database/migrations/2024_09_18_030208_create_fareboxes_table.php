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
        Schema::create(table: 'data_farebox', callback: function (Blueprint $table): void {
            $table->id('seq_no');
            $table->string('passenger_name');
            $table->foreignId('bak')->constrained('dokumen_bak')->cascadeOnDelete()->nullable();
            $table->string('nik_passport_no');
            $table->string('nationality');
            $table->string('order_no');
            $table->date('departure_date');
            $table->string('train_no');
            $table->string('origin');
            $table->string('cars_number');
            $table->string('seat_number');
            $table->string('origin_code');
            $table->date('purchase_date');
            $table->time('purchase_time');
            $table->time('departure_time');
            $table->string('destination');
            $table->string('destination_code');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->string('seat_class');
            $table->string('ticket_type');
            $table->integer('original_ticket_price');
            $table->string('discount_type');
            $table->integer('discount_rate');
            $table->integer('before_tax_price');
            $table->decimal('tax_rate', 4, 2);
            $table->integer('after_tax_price');
            $table->string('ticketing_channel');
            $table->string('payment_method');
            $table->string('trade_no');
            $table->string('plat_trade_no');
            $table->string('payment_gateway')->nullable();
            $table->string('b2b_partner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'data_farebox');
    }
};
