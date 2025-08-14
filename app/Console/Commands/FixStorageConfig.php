<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class FixStorageConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:storage-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnostica e risolve problemi di configurazione storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Diagnostica Configurazione Storage');
        $this->newLine();

        // Test 1: Verifica configurazione
        $this->testConfiguration();

        // Test 2: Verifica permessi cartelle
        $this->testFolderPermissions();

        // Test 3: Test accesso file
        $this->testFileAccess();

        // Test 4: Risoluzione problemi
        $this->fixIssues();

        $this->newLine();
        $this->info('✅ Diagnostica completata!');
        
        return 0;
    }

    private function testConfiguration()
    {
        $this->info('📋 Test 1: Configurazione');
        
        $defaultDisk = config('filesystems.default');
        $this->line("   Disk di default: $defaultDisk");
        
        $publicDisk = config('filesystems.disks.public');
        $this->line("   Disk pubblico configurato: " . (isset($publicDisk) ? '✅ SI' : '❌ NO'));
        
        if (isset($publicDisk)) {
            $this->line("   Root: {$publicDisk['root']}");
            $this->line("   URL: {$publicDisk['url']}");
            $this->line("   Driver: {$publicDisk['driver']}");
        }
        
        // Forza configurazione
        Config::set('filesystems.default', 'public');
        $this->line("   Disk forzato a: " . config('filesystems.default'));
        
        $this->newLine();
    }

    private function testFolderPermissions()
    {
        $this->info('📁 Test 2: Permessi Cartelle');
        
        $storagePath = storage_path('app/public/company-logos');
        $publicPath = public_path('storage/company-logos');
        
        $this->line("   Storage path: " . (is_dir($storagePath) ? '✅ Esiste' : '❌ Non esiste'));
        $this->line("   Public path: " . (is_dir($publicPath) ? '✅ Esiste' : '❌ Non esiste'));
        
        if (is_dir($storagePath)) {
            $this->line("   Storage writable: " . (is_writable($storagePath) ? '✅ SI' : '❌ NO'));
        }
        
        if (is_dir($publicPath)) {
            $this->line("   Public writable: " . (is_writable($publicPath) ? '✅ SI' : '❌ NO'));
        }
        
        // Verifica link simbolico
        $linkPath = public_path('storage');
        $linkTarget = storage_path('app/public');
        
        if (is_link($linkPath)) {
            $this->line("   Link simbolico: " . (readlink($linkPath) === $linkTarget ? '✅ Corretto' : '❌ Sbagliato'));
        } else {
            $this->line("   Link simbolico: ❌ Non esiste");
        }
        
        $this->newLine();
    }

    private function testFileAccess()
    {
        $this->info('📤 Test 3: Accesso File');
        
        try {
            // Test creazione file
            $testFile = 'test-' . time() . '.txt';
            $content = 'Test content ' . date('Y-m-d H:i:s');
            
            $result = Storage::disk('public')->put('company-logos/' . $testFile, $content);
            $this->line("   File creato: " . ($result ? '✅ SI' : '❌ NO'));
            
            if ($result) {
                // Test lettura
                $readContent = Storage::disk('public')->get('company-logos/' . $testFile);
                $this->line("   File letto: " . ($readContent === $content ? '✅ SI' : '❌ NO'));
                
                // Test URL
                $url = Storage::disk('public')->url('company-logos/' . $testFile);
                $this->line("   URL generato: $url");
                
                // Test accesso pubblico
                $publicFile = public_path('storage/company-logos/' . $testFile);
                $publicExists = file_exists($publicFile);
                $this->line("   Accesso pubblico: " . ($publicExists ? '✅ SI' : '❌ NO'));
                
                // Pulisci
                Storage::disk('public')->delete('company-logos/' . $testFile);
            }
            
        } catch (\Exception $e) {
            $this->error("   Errore: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function fixIssues()
    {
        $this->info('🔧 Test 4: Risoluzione Problemi');
        
        // Problema 1: Disk di default sbagliato
        if (config('filesystems.default') !== 'public') {
            $this->line("   Problema: Disk di default è '" . config('filesystems.default') . "' invece di 'public'");
            $this->line("   Soluzione: Forzato disk a 'public' per questa sessione");
            Config::set('filesystems.default', 'public');
        }
        
        // Problema 2: Link simbolico mancante
        $linkPath = public_path('storage');
        if (!is_link($linkPath)) {
            $this->line("   Problema: Link simbolico mancante");
            $this->line("   Soluzione: Eseguire 'php artisan storage:link'");
        }
        
        // Problema 3: Cartella company-logos mancante
        $storagePath = storage_path('app/public/company-logos');
        if (!is_dir($storagePath)) {
            $this->line("   Problema: Cartella company-logos mancante");
            $this->line("   Soluzione: Creazione cartella");
            mkdir($storagePath, 0755, true);
        }
        
        $this->newLine();
    }
}
