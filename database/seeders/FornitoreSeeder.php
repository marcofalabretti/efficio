<?php

namespace Database\Seeders;

use App\Models\Fornitore;
use Illuminate\Database\Seeder;

class FornitoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornitori = [
            [
                'ragione_sociale' => 'Fornitore Generale Srl',
                'partita_iva' => 'IT12345678901',
                'codice_fiscale' => 'FRNGNL80A01H501U',
                'indirizzo' => 'Via Roma 123',
                'cap' => '00100',
                'citta' => 'Roma',
                'provincia' => 'RM',
                'telefono' => '06 1234567',
                'email' => 'info@fornitoregenerale.it',
                'pec' => 'pec@fornitoregenerale.it',
                'sdi' => 'T04ZHR3',
                'note' => 'Fornitore principale per materiali di cancelleria',
                'attivo' => true,
            ],
            [
                'ragione_sociale' => 'Tecnologie Avanzate SpA',
                'partita_iva' => 'IT98765432109',
                'codice_fiscale' => 'TCHAVN75B02F205X',
                'indirizzo' => 'Corso Italia 456',
                'cap' => '20100',
                'citta' => 'Milano',
                'provincia' => 'MI',
                'telefono' => '02 9876543',
                'email' => 'info@tecnologieavanzate.it',
                'pec' => 'pec@tecnologieavanzate.it',
                'sdi' => 'T04ZHR3',
                'note' => 'Specializzato in componenti elettronici',
                'attivo' => true,
            ],
            [
                'ragione_sociale' => 'Materiali Edili Rossi',
                'partita_iva' => 'IT45678912345',
                'codice_fiscale' => 'MTRRSS82C03G273Y',
                'indirizzo' => 'Via Napoli 789',
                'cap' => '80100',
                'citta' => 'Napoli',
                'provincia' => 'NA',
                'telefono' => '081 4567890',
                'email' => 'info@materialiedilirossi.it',
                'pec' => 'pec@materialiedilirossi.it',
                'sdi' => 'T04ZHR3',
                'note' => 'Materiali per edilizia e ristrutturazione',
                'attivo' => true,
            ],
            [
                'ragione_sociale' => 'Servizi Informatici Verdi',
                'partita_iva' => 'IT78912345678',
                'codice_fiscale' => 'SRVVND85D04H456Z',
                'indirizzo' => 'Via Firenze 321',
                'cap' => '50100',
                'citta' => 'Firenze',
                'provincia' => 'FI',
                'telefono' => '055 7891234',
                'email' => 'info@serviziinformaticiverdi.it',
                'pec' => 'pec@serviziinformaticiverdi.it',
                'sdi' => 'T04ZHR3',
                'note' => 'Servizi IT e consulenza tecnica',
                'attivo' => true,
            ],
            [
                'ragione_sociale' => 'Logistica Blu Srl',
                'partita_iva' => 'IT32165498765',
                'codice_fiscale' => 'LGSBLU78E05I789W',
                'indirizzo' => 'Via Palermo 654',
                'cap' => '90100',
                'citta' => 'Palermo',
                'provincia' => 'PA',
                'telefono' => '091 3216549',
                'email' => 'info@logisticablu.it',
                'pec' => 'pec@logisticablu.it',
                'sdi' => 'T04ZHR3',
                'note' => 'Servizi di trasporto e logistica',
                'attivo' => false,
            ],
        ];

        foreach ($fornitori as $fornitore) {
            Fornitore::create($fornitore);
        }
    }
}
