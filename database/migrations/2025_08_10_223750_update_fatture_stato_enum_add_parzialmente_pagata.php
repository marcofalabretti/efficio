<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Aggiorna l'enum per includere il nuovo stato
        DB::statement("ALTER TABLE fatture MODIFY COLUMN stato ENUM('bozza', 'inviata', 'parzialmente_pagata', 'pagata', 'scaduta', 'annullata') DEFAULT 'bozza'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rimuove il nuovo stato dall'enum
        DB::statement("ALTER TABLE fatture MODIFY COLUMN stato ENUM('bozza', 'inviata', 'pagata', 'scaduta', 'annullata') DEFAULT 'bozza'");
    }
};
