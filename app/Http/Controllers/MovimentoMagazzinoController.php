<?php

namespace App\Http\Controllers;

use App\Models\MovimentoMagazzino;
use App\Models\Articolo;
use App\Models\Fornitore;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MovimentoMagazzinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = MovimentoMagazzino::with(['articolo', 'fornitore', 'customer', 'createdBy']);

        // Filtri
        if ($request->filled('articolo_id')) {
            $query->where('articolo_id', $request->articolo_id);
        }

        if ($request->filled('tipo_movimento')) {
            $query->where('tipo_movimento', $request->tipo_movimento);
        }

        if ($request->filled('fornitore_id')) {
            $query->where('fornitore_id', $request->fornitore_id);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('data_da')) {
            $query->whereDate('created_at', '>=', $request->data_da);
        }

        if ($request->filled('data_a')) {
            $query->whereDate('created_at', '<=', $request->data_a);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('articolo', function($subQ) use ($search) {
                    $subQ->where('codice', 'like', "%{$search}%")
                          ->orWhere('nome', 'like', "%{$search}%");
                })
                ->orWhere('numero_documento', 'like', "%{$search}%")
                ->orWhere('causale', 'like', "%{$search}%");
            });
        }

        $movimenti = $query->orderBy('created_at', 'desc')->paginate(25);

        $articoli = Articolo::attivi()->orderBy('nome')->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();
        $customers = Customer::orderBy('name')->get();

        return view('movimenti-magazzino.index', compact('movimenti', 'articoli', 'fornitori', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $articoli = Articolo::attivi()->orderBy('nome')->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();
        $customers = Customer::orderBy('name')->get();

        return view('movimenti-magazzino.create', compact('articoli', 'fornitori', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'articolo_id' => 'required|exists:articoli,id',
            'tipo_movimento' => 'required|in:carico,scarico,trasferimento,inventario,reso,altro',
            'quantita' => 'required|numeric|min:0.01',
            'prezzo_unitario' => 'nullable|numeric|min:0',
            'causale' => 'nullable|string|max:200',
            'note' => 'nullable|string',
            'fornitore_id' => 'nullable|exists:fornitori,id',
            'customer_id' => 'nullable|exists:customers,id',
            'documento_tipo' => 'nullable|string|max:50',
            'numero_documento' => 'nullable|string|max:50',
        ]);

        try {
            DB::beginTransaction();

            $articolo = Articolo::findOrFail($request->articolo_id);
            $quantitaPrecedente = $articolo->giacenza_attuale;

            // Calcola la nuova giacenza
            $quantitaSuccessiva = $quantitaPrecedente;
            if ($request->tipo_movimento === 'carico') {
                $quantitaSuccessiva += $request->quantita;
            } else {
                $quantitaSuccessiva -= $request->quantita;
                if ($quantitaSuccessiva < 0) {
                    $quantitaSuccessiva = 0;
                }
            }

            // Crea il movimento
            $movimento = MovimentoMagazzino::create([
                'articolo_id' => $request->articolo_id,
                'tipo_movimento' => $request->tipo_movimento,
                'quantita' => $request->quantita,
                'quantita_precedente' => $quantitaPrecedente,
                'quantita_successiva' => $quantitaSuccessiva,
                'prezzo_unitario' => $request->prezzo_unitario,
                'causale' => $request->causale,
                'note' => $request->note,
                'fornitore_id' => $request->fornitore_id,
                'customer_id' => $request->customer_id,
                'documento_tipo' => $request->documento_tipo,
                'numero_documento' => $request->numero_documento,
                'created_by' => auth()->id(),
            ]);

            // Aggiorna la giacenza dell'articolo
            $articolo->giacenza_attuale = $quantitaSuccessiva;
            $articolo->save();

            DB::commit();

            return redirect()->route('movimenti-magazzino.index')
                ->with('success', 'Movimento di magazzino registrato con successo.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Errore durante la registrazione del movimento: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MovimentoMagazzino $movimento): View
    {
        $movimento->load(['articolo', 'fornitore', 'customer', 'createdBy']);
        
        return view('movimenti-magazzino.show', compact('movimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovimentoMagazzino $movimento): View
    {
        $articoli = Articolo::attivi()->orderBy('nome')->get();
        $fornitori = Fornitore::attivi()->orderBy('ragione_sociale')->get();
        $customers = Customer::orderBy('name')->get();

        return view('movimenti-magazzino.edit', compact('movimento', 'articoli', 'fornitori', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovimentoMagazzino $movimento): RedirectResponse
    {
        $request->validate([
            'causale' => 'nullable|string|max:200',
            'note' => 'nullable|string',
            'fornitore_id' => 'nullable|exists:fornitori,id',
            'customer_id' => 'nullable|exists:customers,id',
            'documento_tipo' => 'nullable|string|max:50',
            'numero_documento' => 'nullable|string|max:50',
        ]);

        $movimento->update($request->only([
            'causale', 'note', 'fornitore_id', 'customer_id', 
            'documento_tipo', 'numero_documento'
        ]));

        return redirect()->route('movimenti-magazzino.show', $movimento)
            ->with('success', 'Movimento aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovimentoMagazzino $movimento): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Ripristina la giacenza precedente
            $articolo = $movimento->articolo;
            $articolo->giacenza_attuale = $movimento->quantita_precedente;
            $articolo->save();

            $movimento->delete();

            DB::commit();

            return redirect()->route('movimenti-magazzino.index')
                ->with('success', 'Movimento eliminato con successo.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Errore durante l\'eliminazione: ' . $e->getMessage()]);
        }
    }

    /**
     * Mostra il report di magazzino
     */
    public function report(): View
    {
        $statistiche = [
            'totale_articoli' => Articolo::count(),
            'articoli_attivi' => Articolo::attivi()->count(),
            'articoli_sotto_scorta' => Articolo::sottoScorta()->count(),
            'articoli_esauriti' => Articolo::where('giacenza_attuale', '<=', 0)->count(),
            'valore_totale_giacenza' => Articolo::sum(DB::raw('giacenza_attuale * prezzo_acquisto')),
        ];

        $movimenti_recenti = MovimentoMagazzino::with(['articolo', 'fornitore'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $articoli_sotto_scorta = Articolo::sottoScorta()
            ->with(['categoria', 'fornitore'])
            ->get();

        return view('movimenti-magazzino.report', compact('statistiche', 'movimenti_recenti', 'articoli_sotto_scorta'));
    }

    /**
     * API per ottenere i movimenti di un articolo
     */
    public function byArticolo(Articolo $articolo)
    {
        $movimenti = $articolo->movimentiMagazzino()
            ->with(['fornitore', 'customer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($movimenti);
    }
}
