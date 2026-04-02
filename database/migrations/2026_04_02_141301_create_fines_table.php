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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            
            // FK → loans con CASCADE on delete
            $table->foreignId('loan_id')
                ->constrained('loans')
                ->cascadeOnDelete();
            
            // amount: decimal(8,2) requerido
            $table->decimal('amount', 8, 2);
            
            // reason: string(255) requerido
            $table->string('reason', 255);
            
            // status: enum (pending, paid) default 'pending'
            $table->enum('status', ['pending', 'paid'])->default('pending');
            
            // paid_at: date nullable
            $table->date('paid_at')->nullable();
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
