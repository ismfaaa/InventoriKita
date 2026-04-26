<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('asets', function (Blueprint $table) {
            // Menambahkan kolom foto tipe varchar(255) dan boleh kosong (nullable)
            $table->string('foto')->nullable()->after('lokasi');
        });
    }

    public function down()
    {
        Schema::table('asets', function (Blueprint $table) {
            // Menghapus kolom foto kalau kita melakukan rollback
            $table->dropColumn('foto');
        });
    }
};