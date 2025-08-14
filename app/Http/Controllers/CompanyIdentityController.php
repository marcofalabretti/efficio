<?php

namespace App\Http\Controllers;

use App\Models\CompanyIdentity;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class CompanyIdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $identities = CompanyIdentity::orderBy('company_name')->paginate(20);
        return view('company-identity.index', compact('identities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('company-identity.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'commercial_name' => 'nullable|string|max:255',
            'slogan' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mission' => 'nullable|string|max:1000',
            'vision' => 'nullable|string|max:1000',
            'values' => 'nullable|array',
            'values.*' => 'string|max:200',
            'partita_iva' => 'nullable|string|max:50',
            'codice_fiscale' => 'nullable|string|max:50',
            'rea' => 'nullable|string|max:50',
            'legal_address' => 'nullable|string|max:1000',
            'pec' => 'nullable|email|max:255',
            'sdi' => 'nullable|string|max:50',
            'logo_large' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'logo_icon' => 'nullable|image|mimes:jpeg,png,svg|max:1024',
            'logo_horizontal' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'logo_vertical' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'primary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'secondary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'neutral_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'success_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'error_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'primary_font' => 'required|string|max:100',
            'secondary_font' => 'required|string|max:100',
            'style_type' => 'required|in:corporate,creative,minimal',
            'social_media' => 'nullable|array',
            'contact_channels' => 'nullable|array',
            'branch_code' => 'nullable|string|max:50',
            'branch_name' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        // Gestione upload file
        $logoFields = ['logo_large', 'logo_icon', 'logo_horizontal', 'logo_vertical', 'favicon'];
        foreach ($logoFields as $field) {
            if ($request->hasFile($field)) {
                try {
                    $file = $request->file($field);
                    \Log::info("Upload file: {$field}", [
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'disk' => 'public'
                    ]);
                    
                    $path = $file->store('company-logos', 'public');
                    $validated[$field] = $path;
                    
                    \Log::info("File salvato: {$field}", [
                        'path' => $path,
                        'full_path' => storage_path('app/public/' . $path),
                        'exists' => \Storage::disk('public')->exists($path)
                    ]);
                } catch (\Exception $e) {
                    \Log::error("Errore upload file: {$field}", [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    
                    return back()->withErrors([$field => "Errore durante l'upload: " . $e->getMessage()]);
                }
            }
        }

        CompanyIdentity::create($validated);

        return redirect()->route('company-identity.index')
            ->with('success', 'Identità aziendale creata con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyIdentity $companyIdentity): View
    {
        return view('company-identity.show', compact('companyIdentity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyIdentity $companyIdentity): View
    {
        return view('company-identity.edit', compact('companyIdentity'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, CompanyIdentity $companyIdentity): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'commercial_name' => 'nullable|string|max:255',
            'slogan' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mission' => 'nullable|string|max:1000',
            'vision' => 'nullable|string|max:1000',
            'values' => 'nullable|array',
            'values.*' => 'string|max:200',
            'partita_iva' => 'nullable|string|max:255',
            'codice_fiscale' => 'nullable|string|max:255',
            'rea' => 'nullable|string|max:255',
            'legal_address' => 'nullable|string|max:1000',
            'pec' => 'nullable|email|max:255',
            'sdi' => 'nullable|string|max:255',
            'logo_large' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'logo_icon' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'logo_horizontal' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'logo_vertical' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:2048',
            'primary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'secondary_color' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
            'neutral_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'success_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'error_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'primary_font' => 'required|string|max:100',
            'secondary_font' => 'required|string|max:100',
            'style_type' => 'required|in:corporate,creative,minimal',
            'social_media' => 'nullable|array',
            'contact_channels' => 'nullable|array',
            'branch_code' => 'nullable|string|max:50',
            'branch_name' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        // Gestione upload file
        $logoFields = ['logo_large', 'logo_icon', 'logo_horizontal', 'logo_vertical', 'favicon'];
        foreach ($logoFields as $field) {
            if ($request->hasFile($field)) {
                try {
                    $file = $request->file($field);
                    \Log::info("Update file: {$field}", [
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'old_file' => $companyIdentity->$field
                    ]);
                    
                    // Elimina il vecchio file se esiste
                    if ($companyIdentity->$field) {
                        Storage::disk('public')->delete($companyIdentity->$field);
                        \Log::info("File vecchio eliminato: {$field}", ['path' => $companyIdentity->$field]);
                    }
                    
                    $path = $file->store('company-logos', 'public');
                    $validated[$field] = $path;
                    
                    \Log::info("File aggiornato: {$field}", [
                        'path' => $path,
                        'full_path' => storage_path('app/public/' . $path),
                        'exists' => \Storage::disk('public')->exists($path)
                    ]);
                } catch (\Exception $e) {
                    \Log::error("Errore update file: {$field}", [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    
                    return back()->withErrors([$field => "Errore durante l'aggiornamento: " . $e->getMessage()]);
                }
            }
        }

        $companyIdentity->update($validated);

        return redirect()->route('company-identity.index')
            ->with('success', 'Identità aziendale aggiornata con successo.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(CompanyIdentity $companyIdentity): RedirectResponse
    {
        // Elimina i file logo
        $logoFields = ['logo_large', 'logo_icon', 'logo_horizontal', 'logo_vertical', 'favicon'];
        foreach ($logoFields as $field) {
            if ($companyIdentity->$field) {
                Storage::disk('public')->delete($companyIdentity->$field);
            }
        }

        $companyIdentity->delete();

        return redirect()->route('company-identity.index')
            ->with('success', 'Identità aziendale eliminata con successo.');
    }

    /**
     * Toggle dello stato attivo/inattivo
     */
    public function toggleStatus(CompanyIdentity $companyIdentity): RedirectResponse
    {
        $companyIdentity->update(['is_active' => !$companyIdentity->is_active]);
        
        $status = $companyIdentity->is_active ? 'attivata' : 'disattivata';
        return redirect()->route('company-identity.index')
            ->with('success', "Identità aziendale {$status} con successo.");
    }
}
