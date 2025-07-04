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
        $table->text('pesan')->nullable();
        $table->string('status')->default('belum dibaca');
        $table->timestamps();


        $table->foreign('pencairan_id')->references('id')->on('pencairan')->onDelete('cascade');
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
