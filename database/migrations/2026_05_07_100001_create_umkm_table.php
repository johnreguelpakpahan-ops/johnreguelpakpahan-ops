<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->text('deskripsi');
            $table->string('link_referensi', 500)->nullable();
            $table->longText('gambar')->nullable();
            $table->string('lokasi', 255)->nullable();
            $table->string('kontak', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreignId('geosite_id')->constrained('geosite') ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
