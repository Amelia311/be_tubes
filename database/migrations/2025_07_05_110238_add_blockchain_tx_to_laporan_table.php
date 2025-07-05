<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('blockchain_tx')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('blockchain_tx');
        });
    }
    
};
