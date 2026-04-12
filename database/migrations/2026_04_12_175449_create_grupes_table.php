<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grupes', function (Blueprint $table) {
            $table->id();
            $table->string('kodas')->unique();
            $table->string('pavadinimas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupes');
    }
};
