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
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('aset_id')->constrained()->onDelete('cascade');
            $table->enum('status_pelaporan', ['diproses', 'verifikasi', 'selesai']);
            $table->enum('feedback', ['diperbaiki', 'dihilangkan']);
            $table->enum('tingkat_kerusakan', ['rusak ringan', 'rusak berat', 'hilang']);
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tanggal_pelaporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporans');
    }
};
