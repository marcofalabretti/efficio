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
        Schema::create('categorie_articoli', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();
            $table->string('codice', 20)->unique();
            $table->text('descrizione')->nullable();
            $table->string('colore', 7)->default('#3b82f6'); // Colore per UI
            $table->unsignedBigInteger('categoria_padre_id')->nullable();
            $table->boolean('attiva')->default(true);
            $table->integer('ordinamento')->default(0);
            $table->timestamps();
            
            // Indici
            $table->index('codice');
            $table->index('attiva');
            $table->index('ordinamento');
            
            // Foreign key per categorie gerarchiche
            $table->foreign('categoria_padre_id')->references('id')->on('categorie_articoli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_articoli');
    }
};
