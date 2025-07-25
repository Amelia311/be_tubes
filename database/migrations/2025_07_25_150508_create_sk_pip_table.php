<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sk_pip', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sk');
            $table->year('tahun');
            $table->unsignedTinyInteger('semester');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sk_pip');
    }
};
