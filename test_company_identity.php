<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = new Application(
    realpath(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\CompanyIdentity;

try {
    $ci = CompanyIdentity::create([
        'company_name' => 'Test Company',
        'primary_color' => '#3b82f6',
        'secondary_color' => '#6366f1',
        'neutral_color' => '#6b7280',
        'success_color' => '#22c55e',
        'error_color' => '#ef4444',
        'primary_font' => 'Inter',
        'secondary_font' => 'Roboto',
        'style_type' => 'corporate',
        'is_active' => true
    ]);
    
    echo "Test company identity created with ID: " . $ci->id . "\n";
    echo "Company name: " . $ci->company_name . "\n";
    echo "Primary color: " . $ci->primary_color . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
