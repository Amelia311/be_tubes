<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('masalah');
            $table->string('bukti')->nullable();
            $table->enum('status', ['diajukan', 'diproses', 'selesai'])->default('diajukan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pengaduan');
    }
};
