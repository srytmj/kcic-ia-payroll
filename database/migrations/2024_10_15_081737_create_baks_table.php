<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string(column: 'nama_pihak_kedua')->nullable()->default(value: null);
            $table->string(column: 'no_dokumen')->nullable()->default(value: null);
            // $table->integer(column: 'total_nominal')->nullable()->default(value: null);
            $table->date(column: 'tanggal_dokumen')->nullable()->default(value: null);
            $table->enum(column: 'bukti_transfer', allowed: ['0', '1'])->default(value: '0');
            $table->enum(column: 'manifest', allowed: ['0', '1'])->default(value: '0');
            $table->text(column: 'keterangan')->nullable()->default(value: null);
            $table->timestamps();
        });

        schema::create(table: 'dokumen_bak_detail', callback: function (Blueprint $table): void {
            $table->id();
            $table->foreignId(column: 'dokumen_bak_id')->constrained(table: 'dokumen_bak')->onDelete('cascade');
            $table->date(column: 'tanggal_keberangkatan');
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
