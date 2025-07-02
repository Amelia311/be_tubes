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
    Schema::table('pencairan', function (Blueprint $table) {
        $table->string('status')->default('Belum Cair'); // atau nullable() jika tidak mau default
        $table->string('blockchain_tx')->nullable();
    });
}

public function down(): void
{
    Schema::table('pencairan', function (Blueprint $table) {
        $table->dropColumn(['status', 'blockchain_tx']);
    });
}

};
