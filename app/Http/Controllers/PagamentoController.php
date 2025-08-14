<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Fattura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagamenti = Pagamento::with(['fattura.customer', 'creator'])
            ->whereHas('fattura') // Filtra solo i pagamenti con fattura valida
            ->latest()
            ->paginate(15);

        return view('pagamenti.index', compact('pagamenti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fatture = Fattura::where('stato', '!=', Fattura::STATO_ANNULLATA)
            ->with('customer')
            ->get();

        // Se viene passato un fattura_id dalla query string, selezionalo di default
        $fatturaSelezionata = null;
        if ($request->has('fattura_id')) {
            $fatturaSelezionata = Fattura::find($request->fattura_id);
        }

        return view('pagamenti.create', compact('fatture', 'fatturaSelezionata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fattura_id' => 'required|exists:fatture,id',
            'importo' => 'required|numeric|min:0.01',
            'data_pagamento' => 'required|date',
            'metodo_pagamento' => ['required', Rule::in([
                Pagamento::PAGAMENTO_BONIFICO,
                Pagamento::PAGAMENTO_ASSEGNO,
                Pagamento::PAGAMENTO_CARTA,
                Pagamento::PAGAMENTO_CONTANTI
            ])],
            'riferimento_pagamento' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'stato' => ['required', Rule::in([
                Pagamento::STATO_PENDENTE,
                Pagamento::STATO_CONFERMATO,
                Pagamento::STATO_ANNULLATO
            ])],
        ]);

        $pagamento = Pagamento::create([
            'fattura_id' => $request->fattura_id,
            'importo' => $request->importo,
            'data_pagamento' => $request->data_pagamento,
            'metodo_pagamento' => $request->metodo_pagamento,
            'riferimento_pagamento' => $request->riferimento_pagamento,
            'note' => $request->note,
            'stato' => $request->stato,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pagamenti.index')
            ->with('success', 'Pagamento creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $pagamento = Pagamento::find($id);
        
        if (!$pagamento) {
            abort(404, 'Pagamento non trovato');
        }
        
        // Se la richiesta è AJAX, restituisci JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($pagamento);
        }
        
        $pagamento->load(['fattura.customer', 'fattura.commessa', 'creator']);
        
        return view('pagamenti.show', compact('pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pagamento = Pagamento::find($id);
        
        if (!$pagamento) {
            abort(404, 'Pagamento non trovato');
        }
        
        $fatture = Fattura::where('stato', '!=', Fattura::STATO_ANNULLATA)
            ->with('customer')
            ->get();

        return view('pagamenti.edit', compact('pagamento', 'fatture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pagamento = Pagamento::find($id);
        
        if (!$pagamento) {
            abort(404, 'Pagamento non trovato');
        }
        
        $request->validate([
            'fattura_id' => 'required|exists:fatture,id',
            'importo' => 'required|numeric|min:0.01',
            'data_pagamento' => 'required|date',
            'metodo_pagamento' => ['required', Rule::in([
                Pagamento::PAGAMENTO_BONIFICO,
                Pagamento::PAGAMENTO_ASSEGNO,
                Pagamento::PAGAMENTO_CARTA,
                Pagamento::PAGAMENTO_CONTANTI
            ])],
            'riferimento_pagamento' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'stato' => ['required', Rule::in([
                Pagamento::STATO_PENDENTE,
                Pagamento::STATO_CONFERMATO,
                Pagamento::STATO_ANNULLATO
            ])],
        ]);

        $statoPrecedente = $pagamento->stato;

        $pagamento->update([
            'fattura_id' => $request->fattura_id,
            'importo' => $request->importo,
            'data_pagamento' => $request->data_pagamento,
            'metodo_pagamento' => $request->metodo_pagamento,
            'riferimento_pagamento' => $request->riferimento_pagamento,
            'note' => $request->note,
            'stato' => $request->stato,
        ]);

        // Se lo stato è cambiato, aggiorna lo stato della fattura
        if ($statoPrecedente !== $request->stato) {
            $this->aggiornaStatoFattura($pagamento->fattura);
        }

        return redirect()->route('pagamenti.index')
            ->with('success', 'Pagamento aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pagamento = Pagamento::find($id);
        
        if (!$pagamento) {
            abort(404, 'Pagamento non trovato');
        }
        
        $fattura = $pagamento->fattura;
        
        $pagamento->delete();

        // Aggiorna lo stato della fattura dopo la cancellazione
        $this->aggiornaStatoFattura($pagamento->fattura);

        return redirect()->route('pagamenti.index')
            ->with('success', 'Pagamento eliminato con successo.');
    }

    /**
     * Mostra i pagamenti per una specifica fattura
     */
    public function byFattura(Fattura $fattura)
    {
        $pagamenti = $fattura->pagamenti()
            ->with('creator')
            ->latest()
            ->paginate(15);

        return view('pagamenti.by-fattura', compact('fattura', 'pagamenti'));
    }

    /**
     * Aggiorna lo stato della fattura in base ai pagamenti
     */
    private function aggiornaStatoFattura(Fattura $fattura): void
    {
        $importoPagato = $fattura->getImportoPagato();
        
        if ($importoPagato >= $fattura->importo_totale) {
            $fattura->update(['stato' => Fattura::STATO_PAGATA]);
        } elseif ($fattura->stato === Fattura::STATO_PAGATA && $importoPagato < $fattura->importo_totale) {
            // Se era pagata ma ora non lo è più, torna a inviata
            $fattura->update(['stato' => Fattura::STATO_INVIATA]);
        }
    }
}
