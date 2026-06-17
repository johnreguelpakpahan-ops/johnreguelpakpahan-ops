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
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('slug')->unique();
            $table->string('lokasi', 100);
            $table->text('deskripsi');
            $table->string('link_referensi', 500)->nullable();
            $table->longText('gambar_utama')->nullable(); 
            $table->json('tags')->nullable();             
            $table->string('kategori', 100);                         
            $table->boolean('status')->default(true);   
            $table->timestamps();
            $table->foreignId('geosite_id')->constrained('geosite') ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasis');
    }
};
