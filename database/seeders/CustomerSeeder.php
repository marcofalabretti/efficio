<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Azienda Rossi SRL',
                'email' => 'info@aziendarossi.it',
                'phone' => '+39 02 1234567',
                'vat_number' => 'IT12345678901',
                'fiscal_code' => 'RSSRSS80A01H501U',
                'street' => 'Via Roma 123',
                'city' => 'Milano',
                'zip' => '20100',
                'country' => 'Italia',
                'notes' => 'Cliente storico, molto affidabile',
            ],
            [
                'name' => 'Bianchi & Associati',
                'email' => 'contatti@bianchiassociati.com',
                'phone' => '+39 06 9876543',
                'vat_number' => 'IT98765432109',
                'fiscal_code' => 'BNCBNC85B02H502V',
                'street' => 'Corso Italia 456',
                'city' => 'Roma',
                'zip' => '00100',
                'country' => 'Italia',
                'notes' => 'Studio professionale, richiede qualità elevata',
            ],
            [
                'name' => 'Verdi Tecnologie',
                'email' => 'info@verditecnologie.it',
                'phone' => '+39 011 5555666',
                'vat_number' => 'IT55556666777',
                'fiscal_code' => 'VRDVRD90C03H503W',
                'street' => 'Via Torino 789',
                'city' => 'Torino',
                'zip' => '10100',
                'country' => 'Italia',
                'notes' => 'Azienda tecnologica in crescita',
            ],
            [
                'name' => 'Neri Consulting',
                'email' => 'hello@nericonsulting.com',
                'phone' => '+39 081 1111222',
                'vat_number' => 'IT11112222333',
                'fiscal_code' => 'NRINRI75D04H504X',
                'street' => 'Via Napoli 321',
                'city' => 'Napoli',
                'zip' => '80100',
                'country' => 'Italia',
                'notes' => 'Consulenza strategica, progetti complessi',
            ],
            [
                'name' => 'Gialli Design',
                'email' => 'info@giallidesign.it',
                'phone' => '+39 055 7777888',
                'vat_number' => 'IT77778888999',
                'fiscal_code' => 'GLLGLL88E05H505Y',
                'street' => 'Via Firenze 654',
                'city' => 'Firenze',
                'zip' => '50100',
                'country' => 'Italia',
                'notes' => 'Agenzia creativa, attenta ai dettagli',
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        $this->command->info('Clienti creati con successo!');
    }
}
