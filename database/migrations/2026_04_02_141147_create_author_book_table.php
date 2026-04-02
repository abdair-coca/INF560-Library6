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
        Schema::create('author_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                  ->constrained('authors')
                  ->cascadeOnDelete();
 
            $table->foreignId('book_id')
                  ->constrained('books')
                  ->cascadeOnDelete();
 
            $table->string('role', 50)->default('Autor');
            $table->timestamps();
 
            // Evitar duplicados: un autor no puede estar
            // vinculado dos veces al mismo libro
            $table->unique(['author_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_book');
    }
};
