<?php

namespace App\Http\Controllers;

use App\Models\PreventivoRiga;
use App\Models\Preventivo;
use App\Models\Articolo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PreventivoRigaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'preventivo_id' => 'required|exists:preventivi,id',
            'tipo_riga' => 'required|in:manuale,articolo,manodopera',
            'descrizione' => 'required_if:tipo_riga,manuale|string|max:500',
            'articolo_id' => 'nullable|required_if:tipo_riga,articolo|exists:articoli,id',
            'quantita' => 'required|numeric|min:0.01',
            'unita_misura' => 'nullable|string|max:20',
            'prezzo_unitario' => 'required|numeric|min:0',
            'sconto_percentuale' => 'nullable|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        try {
            $preventivo = Preventivo::findOrFail($request->preventivo_id);
            
            // Se è una riga articolo, recupera i dati dall'articolo
            if ($request->tipo_riga === 'articolo' && $request->articolo_id) {
                $articolo = Articolo::findOrFail($request->articolo_id);
                $descrizione = $articolo->nome;
                $unitaMisura = $articolo->unita_misura;
                $prezzoOriginale = $articolo->prezzo_vendita;
                
                // Se non è specificato un prezzo, usa quello dell'articolo
                if (!$request->prezzo_unitario) {
                    $request->merge(['prezzo_unitario' => $articolo->prezzo_vendita]);
                }
            } else {
                $descrizione = $request->descrizione;
                $unitaMisura = $request->unita_misura ?? 'pz';
                $prezzoOriginale = $request->prezzo_unitario;
            }

            // Calcola l'importo totale
            $importoTotale = $request->quantita * $request->prezzo_unitario;
            if ($request->sconto_percentuale) {
                $importoTotale = $importoTotale * (1 - $request->sconto_percentuale / 100);
            }

            // Determina l'ordinamento
            $ordinamento = $request->ordinamento ?? $preventivo->righe()->max('ordinamento') + 1;

            $riga = PreventivoRiga::create([
                'preventivo_id' => $request->preventivo_id,
                'tipo_riga' => $request->tipo_riga,
                'articolo_id' => $request->articolo_id,
                'descrizione' => $descrizione,
                'quantita' => $request->quantita,
                'unita_misura' => $unitaMisura,
                'prezzo_unitario' => $request->prezzo_unitario,
                'prezzo_originale' => $prezzoOriginale,
                'sconto_percentuale' => $request->sconto_percentuale ?? 0,
                'importo_totale' => $importoTotale,
                'note' => $request->note,
                'ordinamento' => $ordinamento,
            ]);

            // Aggiorna i totali del preventivo
            $preventivo->calcolaTotali();

            return response()->json([
                'success' => true,
                'riga' => $riga->load('articolo'),
                'preventivo' => $preventivo->fresh(),
                'message' => 'Riga aggiunta con successo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante il salvataggio: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PreventivoRiga $riga): JsonResponse
    {
        try {
            $riga->load('articolo');
            
            return response()->json([
                'success' => true,
                'id' => $riga->id,
                'tipo_riga' => $riga->tipo_riga,
                'articolo_id' => $riga->articolo_id,
                'articolo' => $riga->articolo,
                'descrizione' => $riga->descrizione,
                'quantita' => $riga->quantita,
                'prezzo_unitario' => $riga->prezzo_unitario,
                'sconto_percentuale' => $riga->sconto_percentuale,
                'note' => $riga->note,
                'importo_totale' => $riga->importo_totale,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel recupero della riga: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreventivoRiga $riga): JsonResponse
    {
        $request->validate([
            'tipo_riga' => 'required|in:manuale,articolo,manodopera',
            'descrizione' => 'required_if:tipo_riga,manuale|string|max:500',
            'articolo_id' => 'nullable|required_if:tipo_riga,articolo|exists:articoli,id',
            'quantita' => 'required|numeric|min:0.01',
            'unita_misura' => 'nullable|string|max:20',
            'prezzo_unitario' => 'required|numeric|min:0',
            'sconto_percentuale' => 'nullable|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        try {
            $preventivo = $riga->preventivo;
            
            // Se è una riga articolo, recupera i dati dall'articolo
            if ($request->tipo_riga === 'articolo' && $request->articolo_id) {
                $articolo = Articolo::findOrFail($request->articolo_id);
                $descrizione = $articolo->nome;
                $unitaMisura = $articolo->unita_misura;
                $prezzoOriginale = $articolo->prezzo_vendita;
            } else {
                $descrizione = $request->descrizione;
                $unitaMisura = $request->unita_misura ?? 'pz';
                $prezzoOriginale = $request->prezzo_unitario;
            }

            // Calcola l'importo totale
            $importoTotale = $request->quantita * $request->prezzo_unitario;
            if ($request->sconto_percentuale) {
                $importoTotale = $importoTotale * (1 - $request->sconto_percentuale / 100);
            }

            $riga->update([
                'tipo_riga' => $request->tipo_riga,
                'articolo_id' => $request->articolo_id,
                'descrizione' => $descrizione,
                'quantita' => $request->quantita,
                'unita_misura' => $unitaMisura,
                'prezzo_unitario' => $request->prezzo_unitario,
                'prezzo_originale' => $prezzoOriginale,
                'sconto_percentuale' => $request->sconto_percentuale ?? 0,
                'importo_totale' => $importoTotale,
                'note' => $request->note,
                'ordinamento' => $request->ordinamento ?? $riga->ordinamento,
            ]);

            // Aggiorna i totali del preventivo
            $preventivo->calcolaTotali();

            return response()->json([
                'success' => true,
                'riga' => $riga->fresh()->load('articolo'),
                'preventivo' => $preventivo->fresh(),
                'message' => 'Riga aggiornata con successo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante l\'aggiornamento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreventivoRiga $riga): JsonResponse
    {
        try {
            $preventivo = $riga->preventivo;
            $riga->delete();

            // Aggiorna i totali del preventivo
            $preventivo->calcolaTotali();

            return response()->json([
                'success' => true,
                'preventivo' => $preventivo->fresh(),
                'message' => 'Riga eliminata con successo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante l\'eliminazione: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Aggiorna l'ordinamento delle righe
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $request->validate([
            'righe' => 'required|array',
            'righe.*.id' => 'required|exists:preventivo_righe,id',
            'righe.*.ordinamento' => 'required|integer|min:0',
        ]);

        try {
            foreach ($request->righe as $rigaData) {
                PreventivoRiga::where('id', $rigaData['id'])
                    ->update(['ordinamento' => $rigaData['ordinamento']]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ordinamento aggiornato con successo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante l\'aggiornamento dell\'ordinamento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Duplica una riga
     */
    public function duplicate(PreventivoRiga $riga): JsonResponse
    {
        try {
            $nuovaRiga = $riga->replicate();
            $nuovaRiga->ordinamento = $riga->preventivo->righe()->max('ordinamento') + 1;
            $nuovaRiga->save();

            // Aggiorna i totali del preventivo
            $riga->preventivo->calcolaTotali();

            return response()->json([
                'success' => true,
                'riga' => $nuovaRiga->load('articolo'),
                'preventivo' => $riga->preventivo->fresh(),
                'message' => 'Riga duplicata con successo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante la duplicazione: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ricerca articoli per autocompletamento
     */
    public function searchArticoli(Request $request): JsonResponse
    {
        $search = $request->get('q', '');
        
        $articoli = Articolo::attivi()
            ->vendibili()
            ->where(function($query) use ($search) {
                $query->where('codice', 'like', "%{$search}%")
                      ->orWhere('nome', 'like', "%{$search}%")
                      ->orWhere('descrizione', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get(['id', 'codice', 'nome', 'prezzo_vendita', 'unita_misura', 'giacenza_attuale']);

        return response()->json($articoli);
    }
}
