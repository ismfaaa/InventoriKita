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
            $table->string('nama_aset')->after('aset_id'); 
            $table->integer('kuantitas')->default(0)->after('nama_aset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->dropColumn(['nama_aset', 'kuantitas']);
        });
    }
};
