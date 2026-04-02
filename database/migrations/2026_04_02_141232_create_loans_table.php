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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                  ->constrained('books')
                  ->restrictOnDelete();
 
            $table->foreignId('member_id')
                  ->constrained('members')
                  ->restrictOnDelete();
 
            $table->foreignId('loaned_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
 
            $table->date('loan_date');
            $table->date('due_date');
            $table->date('returned_date')->nullable();
            $table->enum('status', ['active', 'returned', 'overdue'])
                  ->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
 
            // Índices para consultas frecuentes
            $table->index('status');
            $table->index('due_date');
            $table->index(['member_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
