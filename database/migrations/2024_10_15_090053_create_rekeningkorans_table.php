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
        Schema::create('dokumen_rekeningkoran', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'periode');
            $table->string(column: 'nomor_rekening');
            $table->string(column: 'file_name');
            $table->string(column: 'file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_rekeningkoran');
    }
};
