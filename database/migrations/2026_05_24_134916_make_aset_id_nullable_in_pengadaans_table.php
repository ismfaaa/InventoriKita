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
        Schema::table('pengadaans', function (Blueprint $table) {
            // Mengubah kolom aset_id agar boleh kosong (nullable)
            $table->foreignId('aset_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->foreignId('aset_id')->nullable(false)->change();
        });
    }
};
