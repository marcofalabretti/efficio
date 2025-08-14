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
        Schema::create('fornitori', function (Blueprint $table) {
            $table->id();
            $table->string('ragione_sociale', 200);
            $table->string('partita_iva', 20)->nullable();
            $table->string('codice_fiscale', 20)->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('cap', 10)->nullable();
            $table->string('citta', 100)->nullable();
            $table->string('provincia', 10)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('sdi', 7)->nullable(); // Codice destinatario per fatturazione elettronica
            $table->text('note')->nullable();
            $table->boolean('attivo')->default(true);
            $table->timestamps();
            
            // Indici
            $table->index('ragione_sociale');
            $table->index('partita_iva');
            $table->index('codice_fiscale');
            $table->index('attivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornitori');
    }
};
