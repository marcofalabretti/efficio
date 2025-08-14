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
        Schema::table('preventivo_righe', function (Blueprint $table) {
            // Aggiungi supporto per articoli
            $table->unsignedBigInteger('articolo_id')->nullable()->after('preventivo_id');
            $table->enum('tipo_riga', ['manuale', 'articolo', 'manodopera'])->default('manuale')->after('articolo_id');
            
            // Campi per gestione prezzi articoli
            $table->decimal('prezzo_originale', 10, 2)->nullable()->after('prezzo_unitario');
            $table->string('unita_misura', 20)->nullable()->after('quantita');
            
            // Indici
            $table->index('articolo_id');
            $table->index('tipo_riga');
            
            // Foreign key
            $table->foreign('articolo_id')->references('id')->on('articoli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preventivo_righe', function (Blueprint $table) {
            $table->dropForeign(['articolo_id']);
            $table->dropIndex(['articolo_id', 'tipo_riga']);
            $table->dropColumn(['articolo_id', 'tipo_riga', 'prezzo_originale', 'unita_misura']);
        });
    }
};
