<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('laporan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pencairan_id');
        $table->text('pesan');
        $table->string('bukti')->nullable();
        $table->string('status')->default('belum dibaca');
        $table->timestamps();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
