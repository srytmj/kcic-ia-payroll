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
        Schema::create(table: 'dokumen_bak', callback: function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'periode');
            $table->string(column: 'file_name');
            $table->string(column: 'file_path');
            $table->string(column: 'status')->default(value: 'pending');
            $table->string(column: 'nama_pihak_ke2')->nullable()->default(value: null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'dokumen_bak');
    }
};
