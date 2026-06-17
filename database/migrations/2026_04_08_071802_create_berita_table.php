<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->longText('konten');
            $table->string('link_referensi', 500)->nullable();
            $table->foreignId('geosite_id')->constrained('geosite') ->cascadeOnDelete();
            $table->longText('gambar')->nullable(); // base64
            $table->string('penulis', 100)->nullable();
            $table->integer('views')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};