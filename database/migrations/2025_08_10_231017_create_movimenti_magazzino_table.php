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
        Schema::create('movimenti_magazzino', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('articolo_id');
            $table->enum('tipo_movimento', ['carico', 'scarico', 'trasferimento', 'inventario', 'reso', 'altro']);
            $table->decimal('quantita', 10, 2);
            $table->decimal('quantita_precedente', 10, 2);
            $table->decimal('quantita_successiva', 10, 2);
            
            // Riferimenti ai documenti
            $table->string('documento_tipo', 50)->nullable(); // 'preventivo', 'fattura', 'ordine', 'inventario', etc.
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->string('numero_documento', 50)->nullable();
            
            // Informazioni aggiuntive
            $table->decimal('prezzo_unitario', 10, 2)->nullable();
            $table->string('causale', 200)->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('fornitore_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            
            $table->timestamps();
            
            // Indici
            $table->index('articolo_id');
            $table->index('tipo_movimento');
            $table->index('documento_tipo');
            $table->index('documento_id');
            $table->index('created_by');
            $table->index('fornitore_id');
            $table->index('customer_id');
            $table->index('created_at');
            
            // Foreign keys
            $table->foreign('articolo_id')->references('id')->on('articoli')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fornitore_id')->references('id')->on('fornitori')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimenti_magazzino');
    }
};
