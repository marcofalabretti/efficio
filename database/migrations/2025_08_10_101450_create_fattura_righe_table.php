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
        Schema::create('fattura_righe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fattura_id')->constrained('fatture')->onDelete('cascade');
            $table->string('descrizione');
            $table->decimal('quantita', 8, 2)->default(1);
            $table->decimal('prezzo_unitario', 10, 2);
            $table->decimal('sconto_percentuale', 5, 2)->default(0);
            $table->decimal('importo_totale', 10, 2);
            $table->text('note')->nullable();
            $table->integer('ordinamento')->default(0);
            $table->timestamps();
            
            $table->index(['fattura_id', 'ordinamento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fattura_righe');
    }
};
