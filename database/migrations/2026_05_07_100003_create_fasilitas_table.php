<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('fasilitas', function (Blueprint $table) {
    $table->id();
    $table->string('nama', 255);
    $table->text('deskripsi');
    $table->longText('gambar')->nullable();
    $table->string('link_referensi', 500)->nullable();
    $table->string('harga', 100)->nullable();
    $table->boolean('status')->default(true);
    $table->foreignId('geosite_id')->constrained('geosite') ->cascadeOnDelete();
    $table->timestamps();
    
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
