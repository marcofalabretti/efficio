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
        Schema::create('articoli', function (Blueprint $table) {
            $table->id();
            $table->string('codice', 50)->unique();
            $table->string('nome', 200);
            $table->text('descrizione')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('fornitore_id')->nullable();
            
            // Prezzi
            $table->decimal('prezzo_acquisto', 10, 2)->default(0);
            $table->decimal('prezzo_vendita', 10, 2)->default(0);
            $table->decimal('prezzo_vendita_minimo', 10, 2)->nullable();
            
            // Gestione magazzino
            $table->decimal('giacenza_attuale', 10, 2)->default(0);
            $table->decimal('giacenza_minima', 10, 2)->default(0);
            $table->string('unita_misura', 20)->default('pz');
            $table->decimal('peso', 8, 3)->nullable(); // in kg
            $table->string('dimensioni')->nullable(); // formato: LxPxH
            
            // Informazioni tecniche
            $table->string('marca', 100)->nullable();
            $table->string('modello', 100)->nullable();
            $table->string('codice_ean', 13)->nullable();
            $table->string('codice_fornitore', 50)->nullable();
            
            // Stato e configurazione
            $table->enum('tipo', ['prodotto', 'servizio', 'manodopera'])->default('prodotto');
            $table->boolean('attivo')->default(true);
            $table->boolean('vendibile')->default(true);
            $table->boolean('acquistabile')->default(true);
            $table->integer('ordinamento')->default(0);
            
            $table->timestamps();
            
            // Indici
            $table->index('codice');
            $table->index('nome');
            $table->index('categoria_id');
            $table->index('fornitore_id');
            $table->index('tipo');
            $table->index('attivo');
            $table->index('vendibile');
            $table->index('giacenza_attuale');
            
            // Foreign keys
            $table->foreign('categoria_id')->references('id')->on('categorie_articoli')->onDelete('set null');
            $table->foreign('fornitore_id')->references('id')->on('fornitori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articoli');
    }
};
