<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\CompanyIdentityController;
use App\Models\CompanyIdentity;
use Illuminate\Support\Facades\Storage;

class TestLogoUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:logo-upload {--identity=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa l\'upload dei logo per l\'identità aziendale';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Test Upload Logo Identità Aziendale');
        $this->newLine();

        $identityId = $this->option('identity');
        
        // Verifica che l'identità esista
        $identity = CompanyIdentity::find($identityId);
        if (!$identity) {
            $this->error("❌ Identità con ID $identityId non trovata!");
            return 1;
        }

        $this->info("📋 Testando upload per: {$identity->company_name}");
        $this->newLine();

        // Test 1: Verifica configurazione storage
        $this->testStorageConfig();

        // Test 2: Crea file di test
        $this->createTestFiles();

        // Test 3: Simula upload
        $this->simulateUpload($identity);

        // Test 4: Verifica risultati
        $this->verifyResults($identity);

        $this->newLine();
        $this->info('✅ Test completato!');
        
        return 0;
    }

    private function testStorageConfig()
    {
        $this->info('🔧 Test 1: Configurazione Storage');
        
        try {
            $defaultDisk = config('filesystems.default');
            $this->line("   Disk di default: $defaultDisk");
            
            $publicDisk = config('filesystems.disks.public');
            $this->line("   Disk pubblico configurato: " . (isset($publicDisk) ? '✅ SI' : '❌ NO'));
            
            if (isset($publicDisk)) {
                $this->line("   Root: {$publicDisk['root']}");
                $this->line("   URL: {$publicDisk['url']}");
                $this->line("   Driver: {$publicDisk['driver']}");
            }
            
            // Verifica cartelle
            $storagePath = storage_path('app/public/company-logos');
            $publicPath = public_path('storage/company-logos');
            
            $this->line("   Storage path: " . (is_dir($storagePath) ? '✅ Esiste' : '❌ Non esiste'));
            $this->line("   Public path: " . (is_dir($publicPath) ? '✅ Esiste' : '❌ Non esiste'));
            
        } catch (\Exception $e) {
            $this->error("   Errore: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function createTestFiles()
    {
        $this->info('📁 Test 2: Creazione File di Test');
        
        try {
            $storagePath = storage_path('app/public/company-logos');
            
            // Crea file di test
            $testFiles = [
                'test-logo.png' => 'fake-png-content-' . time(),
                'test-icon.svg' => '<svg>test-icon</svg>',
                'test-favicon.ico' => 'fake-ico-content'
            ];
            
            foreach ($testFiles as $filename => $content) {
                $filePath = $storagePath . '/' . $filename;
                file_put_contents($filePath, $content);
                
                if (file_exists($filePath)) {
                    $this->line("   ✅ $filename creato");
                } else {
                    $this->line("   ❌ $filename non creato");
                }
            }
            
            // Verifica via Storage facade
            foreach (array_keys($testFiles) as $filename) {
                $exists = Storage::disk('public')->exists('company-logos/' . $filename);
                $this->line("   Storage: $filename " . ($exists ? '✅' : '❌'));
            }
            
        } catch (\Exception $e) {
            $this->error("   Errore: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function simulateUpload($identity)
    {
        $this->info('📤 Test 3: Simulazione Upload');
        
        try {
            // Crea un file di test
            $testImagePath = storage_path('app/public/company-logos/test-logo.png');
            
            if (!file_exists($testImagePath)) {
                $this->error("   ❌ File di test non trovato");
                return;
            }
            
            // Simula una richiesta con file
            $request = new Request();
            $request->files->set('logo_large', new UploadedFile(
                $testImagePath,
                'test-logo.png',
                'image/png',
                null,
                true
            ));
            
            $this->line("   Richiesta simulata: ✅ SI");
            
            // Testa la validazione
            $validated = $request->validate([
                'logo_large' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            ]);
            
            $this->line("   Validazione superata: ✅ SI");
            
            // Simula il salvataggio
            $path = $request->file('logo_large')->store('company-logos', 'public');
            $this->line("   File salvato in: $path");
            
            // Aggiorna l'identità
            $identity->update(['logo_large' => $path]);
            $this->line("   Database aggiornato: ✅ SI");
            
            // Verifica che il file esista
            $exists = Storage::disk('public')->exists($path);
            $this->line("   File esiste in storage: " . ($exists ? '✅ SI' : '❌ NO'));
            
        } catch (\Exception $e) {
            $this->error("   Errore: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function verifyResults($identity)
    {
        $this->info('🔍 Test 4: Verifica Risultati');
        
        try {
            $identity->refresh();
            
            if ($identity->logo_large) {
                $this->line("   Campo logo_large: {$identity->logo_large}");
                
                // Verifica file
                $exists = Storage::disk('public')->exists($identity->logo_large);
                $this->line("   File esiste: " . ($exists ? '✅ SI' : '❌ NO'));
                
                if ($exists) {
                    // Verifica URL
                    $url = Storage::disk('public')->url($identity->logo_large);
                    $this->line("   URL pubblico: $url");
                    
                    // Verifica dimensione
                    $size = Storage::disk('public')->size($identity->logo_large);
                    $this->line("   Dimensione: {$size} bytes");
                    
                    // Verifica accesso pubblico
                    $publicFile = public_path('storage/' . $identity->logo_large);
                    $publicExists = file_exists($publicFile);
                    $this->line("   Accesso pubblico: " . ($publicExists ? '✅ SI' : '❌ NO'));
                }
            } else {
                $this->line("   ❌ Nessun logo caricato");
            }
            
        } catch (\Exception $e) {
            $this->error("   Errore: " . $e->getMessage());
        }
        
        $this->newLine();
    }
}
