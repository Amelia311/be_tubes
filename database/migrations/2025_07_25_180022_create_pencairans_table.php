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
        Schema::create('pencairan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->date('tanggal_cair');
            $table->string('semester');
            $table->integer('jumlah');
            $table->string('bukti')->nullable();
            $table->string('status')->default('Belum Cair')->nullable();
            $table->string('blockchain_tx')->nullable();
            $table->enum('status_konfirmasi', ['belum', 'diterima', 'tidak_sesuai'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencairans');
    }
};
