<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('laporan', function (Blueprint $table) {
        $table->string('bukti')->nullable()->after('pesan');
    });
}

public function down()
{
    Schema::table('laporan', function (Blueprint $table) {
        $table->dropColumn('bukti');
    });
}

};