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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome del progetto
            $table->text('description')->nullable(); // Descrizione
            $table->string('status')->default('attivo'); // Stato: attivo, completato, sospeso, cancellato
            $table->string('priority')->default('media'); // Priorità: bassa, media, alta, critica
            $table->date('start_date')->nullable(); // Data di inizio
            $table->date('due_date')->nullable(); // Data di scadenza
            $table->decimal('budget', 10, 2)->nullable(); // Budget del progetto
            $table->decimal('progress', 5, 2)->default(0); // Progresso (0-100%)
            
            // Relazioni
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null'); // Cliente associato
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // Responsabile progetto
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Creatore
            
            $table->timestamps();
            
            // Indici per performance
            $table->index(['status', 'priority']);
            $table->index(['due_date']);
            $table->index(['customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
