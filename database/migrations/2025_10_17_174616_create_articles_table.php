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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Résumé
            $table->longText('content'); // Contenu markdown
            $table->string('image')->nullable(); // Chemin de l'image
            $table->boolean('published')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Auteur
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Catégorie
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
