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
        Schema::create('bible_verses_segond_1910', function (Blueprint $table) {
            $table->id();
            $table->string('book', 100); // Nom du livre (ex: "Genèse")
            $table->integer('chapter'); // Numéro du chapitre
            $table->integer('verse'); // Numéro du verset
            $table->text('text'); // Texte du verset
            $table->timestamps();
            
            // Index pour améliorer les performances des requêtes
            $table->index(['book', 'chapter', 'verse']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_verses_segond_1910');
    }
};
