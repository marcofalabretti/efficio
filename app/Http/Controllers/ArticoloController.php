<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\CategoriaArticolo;
use App\Models\Fornitore;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Articolo::with(['categoria', 'fornitore']);

        // Filtri
        if ($request->filled('categoria_id')) {
            $query->perCategoria($request->categoria_id);
        }

        if ($request->filled('fornitore_id')) {
            $query->perFornitore($request->fornitore_id);
        }

        if ($request->filled('tipo')) {
            $query->perTipo($request->tipo);
        }

        if ($request->filled('stato_giacenza')) {
            switch ($request->stato_giacenza) {
                case 'sotto_scorta':
                    $query->sottoScorta();
                    break;
                case 'esaurito':
                    $query->where('giacenza_attuale', '<=', 0);
                    break;
                case 'normale':
                    $query->where('giacenza_attuale', '>', 0)
                          ->whereRaw('giacenza_attuale > giacenza_minima');
                    break;
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('codice', 'like', "%{$search}%")
                  ->orWhere('nome', 'like', "%{$search}%")
                  ->orWhere('descrizione', 'like', "%{$search}%");
            });
        }

        $articoli = $query->ordineAlfabetico()->paginate(20);

        $categorie = CategoriaArticolo::attive()->principali()->ordinate()->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();

        return view('articoli.index', compact('articoli', 'categorie', 'fornitori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categorie = CategoriaArticolo::attive()->principali()->ordinate()->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();

        return view('articoli.create', compact('categorie', 'fornitori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'codice' => 'required|string|max:50|unique:articoli',
            'nome' => 'required|string|max:200',
            'descrizione' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorie_articoli,id',
            'fornitore_id' => 'nullable|exists:fornitori,id',
            'prezzo_acquisto' => 'nullable|numeric|min:0',
            'prezzo_vendita' => 'nullable|numeric|min:0',
            'prezzo_vendita_minimo' => 'nullable|numeric|min:0',
            'giacenza_attuale' => 'nullable|numeric|min:0',
            'giacenza_minima' => 'nullable|numeric|min:0',
            'unita_misura' => 'required|string|max:20',
            'peso' => 'nullable|numeric|min:0',
            'dimensioni' => 'nullable|string',
            'marca' => 'nullable|string|max:100',
            'modello' => 'nullable|string|max:100',
            'codice_ean' => 'nullable|string|max:13',
            'codice_fornitore' => 'nullable|string|max:50',
            'tipo' => 'required|in:prodotto,servizio,manodopera',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        // Prepara i dati con valori di default per i campi numerici
        $data = $request->all();
        
        // Imposta valori di default per i campi che non possono essere NULL
        $data['giacenza_minima'] = $data['giacenza_minima'] ?? 0;
        $data['giacenza_attuale'] = $data['giacenza_attuale'] ?? 0;
        $data['ordinamento'] = $data['ordinamento'] ?? 0;
        $data['prezzo_acquisto'] = $data['prezzo_acquisto'] ?? 0;
        $data['prezzo_vendita'] = $data['prezzo_vendita'] ?? 0;
        $data['prezzo_vendita_minimo'] = $data['prezzo_vendita_minimo'] ?? 0;
        
        $articolo = Articolo::create($data);

        // Se è un prodotto e ha giacenza iniziale, registra il movimento
        if ($articolo->isProdotto() && $request->filled('giacenza_attuale') && $request->giacenza_attuale > 0) {
            $articolo->aggiornaGiacenza($request->giacenza_attuale, 'carico');
        }

        return redirect()->route('articoli.index')
            ->with('success', 'Articolo creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articolo $articolo): View
    {
        $articolo->load(['categoria', 'fornitore', 'movimentiMagazzino.utente']);
        
        return view('articoli.show', compact('articolo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articolo $articolo): View
    {
        $categorie = CategoriaArticolo::attive()->principali()->ordinate()->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();

        return view('articoli.edit', compact('articolo', 'categorie', 'fornitori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articolo $articolo): RedirectResponse
    {
        $request->validate([
            'codice' => 'required|string|max:50|unique:articoli,codice,' . $articolo->id,
            'nome' => 'required|string|max:200',
            'descrizione' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorie_articoli,id',
            'fornitore_id' => 'nullable|exists:fornitori,id',
            'prezzo_acquisto' => 'nullable|numeric|min:0',
            'prezzo_vendita' => 'nullable|numeric|min:0',
            'prezzo_vendita_minimo' => 'nullable|numeric|min:0',
            'giacenza_attuale' => 'nullable|numeric|min:0',
            'giacenza_minima' => 'nullable|numeric|min:0',
            'unita_misura' => 'required|string|max:20',
            'peso' => 'nullable|numeric|min:0',
            'dimensioni' => 'nullable|string',
            'marca' => 'nullable|string|max:100',
            'modello' => 'nullable|string|max:100',
            'codice_ean' => 'nullable|string|max:13',
            'codice_fornitore' => 'nullable|string|max:50',
            'tipo' => 'required|in:prodotto,servizio,manodopera',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        // Prepara i dati con valori di default per i campi numerici
        $data = $request->all();
        
        // Imposta valori di default per i campi che non possono essere NULL
        $data['giacenza_minima'] = $data['giacenza_minima'] ?? 0;
        $data['giacenza_attuale'] = $data['giacenza_attuale'] ?? 0;
        $data['ordinamento'] = $data['ordinamento'] ?? 0;
        $data['prezzo_acquisto'] = $data['prezzo_acquisto'] ?? 0;
        $data['prezzo_vendita'] = $data['prezzo_vendita'] ?? 0;
        $data['prezzo_vendita_minimo'] = $data['prezzo_vendita_minimo'] ?? 0;
        
        $articolo->update($data);

        return redirect()->route('articoli.index')
            ->with('success', 'Articolo aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articolo $articolo): RedirectResponse
    {
        // Verifica se ci sono righe di preventivo associate
        if ($articolo->righePreventivo()->count() > 0) {
            return redirect()->route('articoli.index')
                ->with('error', 'Impossibile eliminare l\'articolo: è utilizzato in preventivi.');
        }

        // Verifica se ci sono movimenti di magazzino
        if ($articolo->movimentiMagazzino()->count() > 0) {
            return redirect()->route('articoli.index')
                ->with('error', 'Impossibile eliminare l\'articolo: ci sono movimenti di magazzino associati.');
        }

        $articolo->delete();

        return redirect()->route('articoli.index')
            ->with('success', 'Articolo eliminato con successo.');
    }

    /**
     * Toggle dello stato attivo/inattivo
     */
    public function toggleStato(Articolo $articolo): RedirectResponse
    {
        $articolo->update(['attivo' => !$articolo->attivo]);

        $stato = $articolo->attivo ? 'attivato' : 'disattivato';
        
        return redirect()->route('articoli.index')
            ->with('success', "Articolo {$stato} con successo.");
    }

    /**
     * Gestione movimenti di magazzino
     */
    public function movimento(Request $request, Articolo $articolo): RedirectResponse
    {
        $request->validate([
            'tipo_movimento' => 'required|in:carico,scarico,trasferimento,inventario,reso,altro',
            'quantita' => 'required|numeric|min:0.01',
            'causale' => 'nullable|string|max:200',
            'note' => 'nullable|string',
            'prezzo_unitario' => 'nullable|numeric|min:0',
        ]);

        $articolo->aggiornaGiacenza($request->quantita, $request->tipo_movimento);

        return redirect()->route('articoli.show', $articolo)
            ->with('success', 'Movimento di magazzino registrato con successo.');
    }

    /**
     * API per ottenere gli articoli in formato JSON
     */
    public function apiIndex(Request $request)
    {
        $query = Articolo::with(['categoria', 'fornitore']);

        if ($request->filled('tipo')) {
            $query->perTipo($request->tipo);
        }

        if ($request->filled('vendibile')) {
            $query->vendibili();
        }

        $articoli = $query->attivi()->ordineAlfabetico()->get();

        return response()->json($articoli);
    }

    /**
     * Ricerca articoli per autocompletamento
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $articoli = Articolo::attivi()
            ->where(function($q) use ($query) {
                $q->where('codice', 'like', "%{$query}%")
                  ->orWhere('nome', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'codice', 'nome', 'prezzo_vendita', 'unita_misura', 'giacenza_attuale']);

        return response()->json($articoli);
    }
}
