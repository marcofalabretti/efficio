<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyIdentity;

class CompanyIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Identità principale dell'azienda
        CompanyIdentity::create([
            'company_name' => 'Efficio Srl',
            'commercial_name' => 'Efficio',
            'slogan' => 'Efficienza e Professionalità al tuo Servizio',
            'website' => 'https://www.efficio.it',
            'email' => 'info@efficio.it',
            'phone' => '+39 02 1234567',
            'mission' => 'Fornire soluzioni innovative e servizi di qualità per migliorare l\'efficienza operativa delle aziende.',
            'vision' => 'Essere leader nel settore delle soluzioni aziendali, riconosciuti per l\'innovazione e l\'affidabilità.',
            'values' => [
                'Eccellenza',
                'Innovazione',
                'Affidabilità',
                'Trasparenza',
                'Collaborazione'
            ],
            'partita_iva' => 'IT12345678901',
            'codice_fiscale' => 'EFCSRL85M12H501A',
            'rea' => 'MI-1234567',
            'legal_address' => 'Via Roma 123, 20100 Milano, Italia',
            'pec' => 'efficio@pec.it',
            'sdi' => 'T04ZHR3',
            'primary_color' => '#2563eb',
            'secondary_color' => '#7c3aed',
            'neutral_color' => '#6b7280',
            'success_color' => '#059669',
            'error_color' => '#dc2626',
            'primary_font' => 'Inter',
            'secondary_font' => 'Roboto',
            'style_type' => 'corporate',
            'social_media' => [
                'linkedin' => 'https://linkedin.com/company/efficio',
                'facebook' => 'https://facebook.com/efficio',
                'twitter' => 'https://twitter.com/efficio'
            ],
            'contact_channels' => [
                'whatsapp' => '+39 333 1234567',
                'telegram' => '@efficio_support'
            ],
            'is_active' => true
        ]);

        // Sede secondaria (esempio)
        CompanyIdentity::create([
            'company_name' => 'Efficio Srl',
            'commercial_name' => 'Efficio Roma',
            'slogan' => 'Efficienza e Professionalità al tuo Servizio',
            'website' => 'https://www.efficio.it',
            'email' => 'roma@efficio.it',
            'phone' => '+39 06 1234567',
            'mission' => 'Fornire soluzioni innovative e servizi di qualità per migliorare l\'efficienza operativa delle aziende.',
            'vision' => 'Essere leader nel settore delle soluzioni aziendali, riconosciuti per l\'innovazione e l\'affidabilità.',
            'values' => [
                'Eccellenza',
                'Innovazione',
                'Affidabilità',
                'Trasparenza',
                'Collaborazione'
            ],
            'partita_iva' => 'IT12345678901',
            'codice_fiscale' => 'EFCSRL85M12H501A',
            'rea' => 'MI-1234567',
            'legal_address' => 'Via del Corso 456, 00186 Roma, Italia',
            'pec' => 'efficio@pec.it',
            'sdi' => 'T04ZHR3',
            'primary_color' => '#2563eb',
            'secondary_color' => '#7c3aed',
            'neutral_color' => '#6b7280',
            'success_color' => '#059669',
            'error_color' => '#dc2626',
            'primary_font' => 'Inter',
            'secondary_font' => 'Roboto',
            'style_type' => 'corporate',
            'social_media' => [
                'linkedin' => 'https://linkedin.com/company/efficio',
                'facebook' => 'https://facebook.com/efficio',
                'twitter' => 'https://twitter.com/efficio'
            ],
            'contact_channels' => [
                'whatsapp' => '+39 333 1234567',
                'telegram' => '@efficio_support'
            ],
            'branch_code' => 'RM001',
            'branch_name' => 'Sede di Roma',
            'is_active' => true
        ]);

        $this->command->info('Identità aziendali create con successo!');
    }
}
