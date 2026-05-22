<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ortu_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ortu_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('santri_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ortu_santri');
    }
};
