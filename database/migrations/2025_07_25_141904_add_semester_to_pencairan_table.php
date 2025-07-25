<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pencairan', function (Blueprint $table) {
            $table->enum('semester', ['Ganjil', 'Genap'])->after('keterangan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pencairan', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
    }
};
