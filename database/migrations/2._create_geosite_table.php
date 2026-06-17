<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geosite', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->foreignId('admin_id')->nullable()->default(1)->constrained('admin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geosite');
    }
};
