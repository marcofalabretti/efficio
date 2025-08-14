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
        Schema::table('fatture', function (Blueprint $table) {
            $table->decimal('percentuale_iva', 5, 2)->default(22.00)->after('importo_netto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fatture', function (Blueprint $table) {
            $table->dropColumn('percentuale_iva');
        });
    }
};
