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
        Schema::create('pagamenti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fattura_id')->constrained('fatture')->onDelete('cascade');
            $table->decimal('importo', 10, 2);
            $table->date('data_pagamento');
            $table->enum('metodo_pagamento', ['bonifico', 'assegno', 'carta', 'contanti']);
            $table->string('riferimento_pagamento')->nullable(); // Numero assegno, riferimento bonifico, ecc.
            $table->text('note')->nullable();
            $table->enum('stato', ['pendente', 'confermato', 'annullato'])->default('pendente');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['fattura_id', 'stato']);
            $table->index(['data_pagamento', 'stato']);
            $table->index(['created_by', 'stato']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamenti');
    }
};
