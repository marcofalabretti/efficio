<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CompanyIdentity;

class ManageCompanyIdentity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:identity {action} {--name=} {--email=} {--phone=} {--website=} {--active}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestisce l\'identità aziendale';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listIdentities();
                break;
            case 'create':
                $this->createIdentity();
                break;
            case 'update':
                $this->updateIdentity();
                break;
            case 'delete':
                $this->deleteIdentity();
                break;
            case 'activate':
                $this->activateIdentity();
                break;
            default:
                $this->error('Azione non valida. Usa: list, create, update, delete, activate');
                return 1;
        }

        return 0;
    }

    private function listIdentities()
    {
        $identities = CompanyIdentity::all();
        
        if ($identities->isEmpty()) {
            $this->info('Nessuna identità aziendale trovata.');
            return;
        }

        $this->info('Identità Aziendali:');
        $this->newLine();

        foreach ($identities as $identity) {
            $status = $identity->is_active ? '✅ Attiva' : '❌ Inattiva';
            $branch = $identity->branch_name ? " ({$identity->branch_name})" : '';
            
            $this->line("ID: {$identity->id}");
            $this->line("Nome: {$identity->company_name}{$branch}");
            $this->line("Email: {$identity->email}");
            $this->line("Telefono: {$identity->phone}");
            $this->line("Stato: {$status}");
            $this->line("---");
        }
    }

    private function createIdentity()
    {
        $name = $this->option('name') ?: $this->ask('Nome azienda');
        $email = $this->option('email') ?: $this->ask('Email aziendale');
        $phone = $this->option('phone') ?: $this->ask('Telefono aziendale');
        $website = $this->option('website') ?: $this->ask('Sito web (opzionale)');
        $active = $this->option('active') ?: $this->confirm('Attiva subito?', true);

        $identity = CompanyIdentity::create([
            'company_name' => $name,
            'email' => $email,
            'phone' => $phone,
            'website' => $website,
            'is_active' => $active,
            'primary_color' => '#2563eb',
            'secondary_color' => '#7c3aed',
            'neutral_color' => '#6b7280',
            'success_color' => '#059669',
            'error_color' => '#dc2626',
            'primary_font' => 'Inter',
            'secondary_font' => 'Roboto',
            'style_type' => 'corporate',
        ]);

        $this->info("Identità aziendale '{$name}' creata con successo (ID: {$identity->id})");
    }

    private function updateIdentity()
    {
        $id = $this->ask('ID dell\'identità da aggiornare');
        $identity = CompanyIdentity::find($id);

        if (!$identity) {
            $this->error("Identità con ID {$id} non trovata.");
            return;
        }

        $name = $this->option('name') ?: $this->ask('Nuovo nome azienda', $identity->company_name);
        $email = $this->option('email') ?: $this->ask('Nuova email', $identity->email);
        $phone = $this->option('phone') ?: $this->ask('Nuovo telefono', $identity->phone);
        $website = $this->option('website') ?: $this->ask('Nuovo sito web', $identity->website);

        $identity->update([
            'company_name' => $name,
            'email' => $email,
            'phone' => $phone,
            'website' => $website,
        ]);

        $this->info("Identità aziendale aggiornata con successo.");
    }

    private function deleteIdentity()
    {
        $id = $this->ask('ID dell\'identità da eliminare');
        $identity = CompanyIdentity::find($id);

        if (!$identity) {
            $this->error("Identità con ID {$id} non trovata.");
            return;
        }

        if ($this->confirm("Sei sicuro di voler eliminare '{$identity->company_name}'?")) {
            $identity->delete();
            $this->info("Identità aziendale eliminata con successo.");
        }
    }

    private function activateIdentity()
    {
        $id = $this->ask('ID dell\'identità da attivare');
        $identity = CompanyIdentity::find($id);

        if (!$identity) {
            $this->error("Identità con ID {$id} non trovata.");
            return;
        }

        // Disattiva tutte le altre identità
        CompanyIdentity::where('id', '!=', $id)->update(['is_active' => false]);
        
        // Attiva l'identità selezionata
        $identity->update(['is_active' => true]);

        $this->info("Identità '{$identity->company_name}' attivata con successo.");
    }
}
