<?php

namespace App\Http\Controllers;

use App\Models\Preventivo;
use App\Models\Customer;
use App\Models\Commessa;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PreventivoController extends Controller
{
    public function index()
    {
        $preventivi = Preventivo::with(['customer', 'commessa', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('preventivi.index', compact('preventivi'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $commesse = Commessa::orderBy('nome')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('preventivi.create', compact('customers', 'commesse', 'projects', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:preventivi',
            'data' => 'required|date',
            'data_scadenza' => 'nullable|date|after:data',
            'stato' => 'required|in:' . implode(',', [
                Preventivo::STATO_BOZZA,
                Preventivo::STATO_INVIATO,
                Preventivo::STATO_ACCETTATO,
                Preventivo::STATO_RIFIUTATO,
                Preventivo::STATO_SCADUTO
            ]),
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'commessa_id' => 'nullable|exists:commesse,id',
            'project_id' => 'nullable|exists:projects,id',
            'accettato_da' => 'nullable|exists:users,id',
            'data_accettazione' => 'nullable|date|after:data',
        ]);

        $validated['created_by'] = Auth::id();
        
        // Imposta valori di default per i totali
        $validated['importo_totale'] = 0;
        $validated['importo_iva'] = 0;
        $validated['importo_netto'] = 0;

        $preventivo = Preventivo::create($validated);

        return redirect()->route('preventivi.edit', $preventivo)
            ->with('success', 'Preventivo creato con successo. Ora puoi aggiungere le righe.');
    }

    public function show($id)
    {
        $preventivo = Preventivo::find($id);
        
        if (!$preventivo) {
            abort(404, 'Preventivo non trovato');
        }
        
        $preventivo->load(['customer', 'commessa', 'project', 'creator', 'accettatoDa', 'righe.articolo']);
        
        return view('preventivi.show', compact('preventivo'));
    }

    public function edit($id)
    {
        $preventivo = Preventivo::find($id);
        
        if (!$preventivo) {
            abort(404, 'Preventivo non trovato');
        }
        
        $preventivo->load(['righe.articolo']);
        $customers = Customer::orderBy('name')->get();
        $commesse = Commessa::orderBy('nome')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('preventivi.edit', compact('preventivo', 'customers', 'commesse', 'projects', 'users'));
    }

    public function update(Request $request, $id)
    {
        $preventivo = Preventivo::find($id);
        
        if (!$preventivo) {
            abort(404, 'Preventivo non trovato');
        }
        
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:preventivi,numero,' . $preventivo->id,
            'data' => 'required|date',
            'data_scadenza' => 'required|date|after:data',
            'stato' => 'required|in:' . implode(',', [
                Preventivo::STATO_BOZZA,
                Preventivo::STATO_INVIATO,
                Preventivo::STATO_ACCETTATO,
                Preventivo::STATO_RIFIUTATO,
                Preventivo::STATO_SCADUTO
            ]),
            'importo_totale' => 'required|numeric|min:0',
            'importo_iva' => 'required|numeric|min:0',
            'importo_netto' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'commessa_id' => 'nullable|exists:commesse,id',
            'project_id' => 'nullable|exists:projects,id',
            'accettato_da' => 'nullable|exists:users,id',
            'data_accettazione' => 'nullable|date|after:data',
        ]);

        $preventivo->update($validated);

        return redirect()->route('preventivi.show', $preventivo)
            ->with('success', 'Preventivo aggiornato con successo.');
    }

    public function destroy($id)
    {
        $preventivo = Preventivo::find($id);
        
        if (!$preventivo) {
            abort(404, 'Preventivo non trovato');
        }
        
        $preventivo->delete();

        return redirect()->route('preventivi.index')
            ->with('success', 'Preventivo eliminato con successo.');
    }

    public function byCustomer(Customer $customer)
    {
        $preventivi = $customer->preventivi()
            ->with(['commessa', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('preventivi.index', compact('preventivi', 'customer'));
    }

    public function byCommessa(Commessa $commessa)
    {
        $preventivi = $commessa->preventivi()
            ->with(['customer', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('preventivi.index', compact('preventivi', 'commessa'));
    }

    public function generatePdf($id)
    {
        $preventivo = Preventivo::with(['customer', 'commessa', 'project', 'creator', 'accettatoDa', 'righe.articolo'])->findOrFail($id);
        
        $pdf = Pdf::loadView('preventivi.print', compact('preventivo'));
        
        // Pulisce il numero rimuovendo caratteri non validi per i nomi file
        $numeroPulito = preg_replace('/[\/\\\:*?"<>|]/', '_', $preventivo->numero);
        $filename = 'Preventivo-' . $numeroPulito . '-' . date('Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}
