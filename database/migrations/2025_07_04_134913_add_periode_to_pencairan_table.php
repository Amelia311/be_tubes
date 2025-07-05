<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pencairan', function (Blueprint $table) {
            $table->string('periode')->nullable()->after('tanggal_cair');
        });
    }

    public function down(): void
    {
        Schema::table('pencairan', function (Blueprint $table) {
            $table->dropColumn('periode');
        });
    }
};
