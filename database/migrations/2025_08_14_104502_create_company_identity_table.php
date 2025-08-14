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
        Schema::create('company_identity', function (Blueprint $table) {
            $table->id();
            
            // Informazioni Base
            $table->string('company_name')->comment('Nome azienda principale');
            $table->string('commercial_name')->nullable()->comment('Nome commerciale');
            $table->string('slogan')->nullable()->comment('Slogan/Tagline aziendale');
            $table->string('website')->nullable()->comment('Sito web aziendale');
            $table->string('email')->nullable()->comment('Email di contatto principale');
            $table->string('phone')->nullable()->comment('Telefono principale');
            
            // Contenuti Aziendali
            $table->text('mission')->nullable()->comment('Mission aziendale');
            $table->text('vision')->nullable()->comment('Vision aziendale');
            $table->json('values')->nullable()->comment('Valori aziendali');
            
            // Informazioni Legali
            $table->string('partita_iva')->nullable()->comment('Partita IVA');
            $table->string('codice_fiscale')->nullable()->comment('Codice Fiscale');
            $table->string('rea')->nullable()->comment('REA');
            $table->text('legal_address')->nullable()->comment('Indirizzo legale completo');
            $table->string('pec')->nullable()->comment('PEC');
            $table->string('sdi')->nullable()->comment('Sistema di Interscambio');
            
            // Elementi Visivi
            $table->string('logo_large')->nullable()->comment('Logo grande per documenti');
            $table->string('logo_icon')->nullable()->comment('Logo icona per favicon');
            $table->string('logo_horizontal')->nullable()->comment('Logo orizzontale');
            $table->string('logo_vertical')->nullable()->comment('Logo verticale');
            $table->string('favicon')->nullable()->comment('Favicon');
            
            // Colori Brand
            $table->string('primary_color', 7)->default('#6366f1')->comment('Colore primario brand');
            $table->string('secondary_color', 7)->default('#8b5cf6')->comment('Colore secondario brand');
            $table->string('neutral_color', 7)->default('#6b7280')->comment('Colore neutro');
            $table->string('success_color', 7)->default('#10b981')->comment('Colore successo');
            $table->string('error_color', 7)->default('#ef4444')->comment('Colore errore');
            
            // Font e Stile
            $table->string('primary_font')->default('Inter')->comment('Font principale');
            $table->string('secondary_font')->default('system-ui')->comment('Font secondario');
            $table->string('style_type')->default('corporate')->comment('Tipo stile: corporate, creative, minimal');
            
            // Social e Contatti
            $table->json('social_media')->nullable()->comment('Social media e canali');
            $table->json('contact_channels')->nullable()->comment('Canali di contatto aggiuntivi');
            
            // Impostazioni Multi-Sede
            $table->string('branch_code')->nullable()->comment('Codice sede/filiale');
            $table->string('branch_name')->nullable()->comment('Nome sede/filiale');
            $table->boolean('is_active')->default(true)->comment('Identità attiva');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_identity');
    }
};
