<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verse_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('verse_id'); // pas de foreign key ici
            $table->text('content');
            $table->timestamps();

            $table->index(['user_id', 'verse_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verse_comments');
    }
};
