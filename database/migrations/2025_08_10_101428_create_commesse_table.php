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
        Schema::create('commesse', function (Blueprint $table) {
            $table->id();
            $table->string('codice')->unique();
            $table->string('nome');
            $table->text('descrizione')->nullable();
            $table->enum('stato', ['attiva', 'completata', 'sospesa', 'annullata'])->default('attiva');
            $table->date('data_inizio');
            $table->date('data_fine_prevista')->nullable();
            $table->date('data_fine_effettiva')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->decimal('ore_stimate', 8, 2)->nullable();
            $table->decimal('ore_effettive', 8, 2)->nullable();
            $table->text('note')->nullable();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('responsabile_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['customer_id', 'stato']);
            $table->index(['project_id', 'stato']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commesse');
    }
};
