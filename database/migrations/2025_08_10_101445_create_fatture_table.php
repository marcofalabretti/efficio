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
        Schema::create('fatture', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->date('data');
            $table->date('data_scadenza')->nullable();
            $table->enum('stato', ['bozza', 'inviata', 'pagata', 'scaduta', 'annullata'])->default('bozza');
            $table->decimal('importo_totale', 10, 2)->default(0);
            $table->decimal('importo_iva', 10, 2)->default(0);
            $table->decimal('importo_netto', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('commessa_id')->nullable()->constrained('commesse')->onDelete('set null');
            $table->foreignId('preventivo_id')->nullable()->constrained('preventivi')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->date('data_pagamento')->nullable();
            $table->decimal('importo_pagato', 10, 2)->default(0);
            $table->enum('metodo_pagamento', ['bonifico', 'assegno', 'carta', 'contanti'])->nullable();
            $table->timestamps();
            
            $table->index(['customer_id', 'stato']);
            $table->index(['commessa_id', 'stato']);
            $table->index(['preventivo_id', 'stato']);
            $table->index(['data_scadenza', 'stato']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatture');
    }
};
