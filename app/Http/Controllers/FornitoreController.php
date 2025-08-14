<?php

namespace App\Http\Controllers;

use App\Models\Fornitore;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FornitoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Fornitore::withCount(['articoli', 'movimentiMagazzino']);

        // Filtro per stato
        if ($request->filled('stato')) {
            $query->where('attivo', $request->stato);
        }

        // Filtro per città
        if ($request->filled('citta')) {
            $query->where('citta', $request->citta);
        }

        // Filtro di ricerca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ragione_sociale', 'like', "%{$search}%")
                  ->orWhere('partita_iva', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('codice_fiscale', 'like', "%{$search}%");
            });
        }

        $fornitori = $query->orderBy('ragione_sociale')->paginate(20);

        // Ottieni tutte le città uniche per il filtro
        $citta = Fornitore::whereNotNull('citta')
            ->where('citta', '!=', '')
            ->distinct()
            ->pluck('citta')
            ->sort()
            ->values();

        return view('fornitori.index', compact('fornitori', 'citta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('fornitori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ragione_sociale' => 'required|string|max:200',
            'partita_iva' => 'nullable|string|max:20|unique:fornitori',
            'codice_fiscale' => 'nullable|string|max:20|unique:fornitori',
            'indirizzo' => 'nullable|string',
            'cap' => 'nullable|string|max:10',
            'citta' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:fornitori',
            'pec' => 'nullable|email|unique:fornitori',
            'sdi' => 'nullable|string|max:7',
            'note' => 'nullable|string',
        ]);

        Fornitore::create($request->all());

        return redirect()->route('fornitori.index')
            ->with('success', 'Fornitore creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornitore $fornitore): View
    {
        $fornitore->load(['articoli', 'movimentiMagazzino']);
        
        return view('fornitori.show', compact('fornitore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornitore $fornitore): View
    {
        return view('fornitori.edit', compact('fornitore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornitore $fornitore): RedirectResponse
    {
        $request->validate([
            'ragione_sociale' => 'required|string|max:200',
            'partita_iva' => 'nullable|string|max:20|unique:fornitori,partita_iva,' . $fornitore->id,
            'codice_fiscale' => 'nullable|string|max:20|unique:fornitori,codice_fiscale,' . $fornitore->id,
            'indirizzo' => 'nullable|string',
            'cap' => 'nullable|string|max:10',
            'citta' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:fornitori,email,' . $fornitore->id,
            'pec' => 'nullable|email|unique:fornitori,pec,' . $fornitore->id,
            'sdi' => 'nullable|string|max:7',
            'note' => 'nullable|string',
        ]);

        $fornitore->update($request->all());

        return redirect()->route('fornitori.index')
            ->with('success', 'Fornitore aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornitore $fornitore): RedirectResponse
    {
        // Verifica se ci sono articoli associati
        if ($fornitore->articoli()->count() > 0) {
            return redirect()->route('fornitori.index')
                ->with('error', 'Impossibile eliminare il fornitore: ci sono articoli associati.');
        }

        // Verifica se ci sono movimenti di magazzino
        if ($fornitore->movimentiMagazzino()->count() > 0) {
            return redirect()->route('fornitori.index')
                ->with('error', 'Impossibile eliminare il fornitore: ci sono movimenti di magazzino associati.');
        }

        $fornitore->delete();

        return redirect()->route('fornitori.index')
            ->with('success', 'Fornitore eliminato con successo.');
    }

    /**
     * Toggle dello stato attivo/inattivo
     */
    public function toggleStato(Fornitore $fornitore): RedirectResponse
    {
        $fornitore->update(['attivo' => !$fornitore->attivo]);

        $stato = $fornitore->attivo ? 'attivato' : 'disattivato';
        
        return redirect()->route('fornitori.index')
            ->with('success', "Fornitore {$stato} con successo.");
    }

    /**
     * API per ottenere i fornitori in formato JSON
     */
    public function apiIndex()
    {
        $fornitori = Fornitore::attivi()
            ->orderBy('ragione_sociale')
            ->get(['id', 'ragione_sociale', 'citta', 'provincia']);

        return response()->json($fornitori);
    }

    /**
     * Ricerca fornitori per autocompletamento
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $fornitori = Fornitore::attivi()
            ->where('ragione_sociale', 'like', "%{$query}%")
            ->orWhere('partita_iva', 'like', "%{$query}%")
            ->orWhere('codice_fiscale', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'ragione_sociale', 'partita_iva', 'citta']);

        return response()->json($fornitori);
    }
}
