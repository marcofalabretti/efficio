<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTestImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:test-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un\'immagine PNG di test valida';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎨 Creazione Immagine PNG di Test');
        
        $storagePath = storage_path('app/public/company-logos');
        $testImagePath = $storagePath . '/test-logo.png';
        
        try {
            // Crea un'immagine PNG semplice
            $image = imagecreate(200, 100);
            
            // Colori
            $white = imagecolorallocate($image, 255, 255, 255);
            $blue = imagecolorallocate($image, 99, 102, 241);
            $black = imagecolorallocate($image, 0, 0, 0);
            
            // Sfondo bianco
            imagefill($image, 0, 0, $white);
            
            // Rettangolo blu
            imagefilledrectangle($image, 10, 10, 190, 90, $blue);
            
            // Testo
            imagestring($image, 5, 60, 40, 'TEST', $white);
            
            // Salva l'immagine
            imagepng($image, $testImagePath);
            imagedestroy($image);
            
            if (file_exists($testImagePath)) {
                $this->info("✅ Immagine creata: $testImagePath");
                
                // Verifica dimensione
                $size = filesize($testImagePath);
                $this->line("   Dimensione: {$size} bytes");
                
                // Verifica tipo MIME
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $testImagePath);
                finfo_close($finfo);
                $this->line("   Tipo MIME: $mimeType");
                
                // Verifica accesso via Storage
                $exists = \Storage::disk('public')->exists('company-logos/test-logo.png');
                $this->line("   Storage access: " . ($exists ? '✅ SI' : '❌ NO'));
                
            } else {
                $this->error("❌ Errore nella creazione dell'immagine");
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Errore: " . $e->getMessage());
        }
        
        return 0;
    }
}
