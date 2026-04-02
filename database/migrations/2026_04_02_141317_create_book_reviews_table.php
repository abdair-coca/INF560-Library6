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
        Schema::create('book_reviews', function (Blueprint $table) {
            $table->id();

            // FK → books con CASCADE on delete
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete();
            
            // FK → members con CASCADE on delete
            $table->foreignId('member_id')
                ->constrained('members')
                ->cascadeOnDelete();
            
            // rating: unsignedTinyInteger requerido (1-5)
            $table->unsignedTinyInteger('rating');
            
            // comment: text nullable
            $table->text('comment')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índice único compuesto: cada miembro solo una reseña por libro
            $table->unique(['book_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_reviews');
    }
};
