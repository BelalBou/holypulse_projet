<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verse_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('verse_id');
            $table->timestamps();

            $table->unique(['user_id', 'verse_id']); // Empêche les doublons
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verse_likes');
    }
};
