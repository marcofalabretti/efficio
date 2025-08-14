<?php

namespace App\Http\Controllers;

use App\Models\Fattura;
use App\Models\Customer;
use App\Models\Commessa;
use App\Models\Preventivo;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FatturaController extends Controller
{
    public function index()
    {
        $fatture = Fattura::with(['customer', 'commessa', 'preventivo', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('fatture.index', compact('fatture'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $commesse = Commessa::orderBy('nome')->get();
        $preventivi = Preventivo::orderBy('numero')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('fatture.create', compact('customers', 'commesse', 'preventivi', 'projects', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:fatture',
            'data' => 'required|date',
            'data_scadenza' => 'nullable|date|after:data',
            'stato' => 'required|in:' . implode(',', [
                Fattura::STATO_BOZZA,
                Fattura::STATO_INVIATA,
                Fattura::STATO_PAGATA,
                Fattura::STATO_SCADUTA,
                Fattura::STATO_ANNULLATA
            ]),
            'importo_netto' => 'required|numeric|min:0',
            'percentuale_iva' => 'required|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'commessa_id' => 'nullable|exists:commesse,id',
            'preventivo_id' => 'nullable|exists:preventivi,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $validated['created_by'] = Auth::id();

        // Calcolo automatico dell'IVA e del totale
        $fattura = new Fattura($validated);
        $fattura->calcolaIva();

        $fattura->save();

        return redirect()->route('fatture.index')
            ->with('success', 'Fattura creata con successo.');
    }

    public function show($id)
    {
        $fattura = Fattura::find($id);
        
        if (!$fattura) {
            abort(404, 'Fattura non trovata');
        }
        
        $fattura->load(['customer', 'commessa', 'preventivo', 'project', 'creator', 'righe', 'pagamenti']);
        
        return view('fatture.show', compact('fattura'));
    }

    public function edit($id)
    {
        $fattura = Fattura::find($id);
        
        if (!$fattura) {
            abort(404, 'Fattura non trovata');
        }
        
        $customers = Customer::orderBy('name')->get();
        $commesse = Commessa::orderBy('nome')->get();
        $preventivi = Preventivo::orderBy('numero')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('fatture.edit', compact('fattura', 'customers', 'commesse', 'preventivi', 'projects', 'users'));
    }

    public function update(Request $request, $id)
    {
        $fattura = Fattura::find($id);
        
        if (!$fattura) {
            abort(404, 'Fattura non trovata');
        }
        
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:fatture,numero,' . $fattura->id,
            'data' => 'required|date',
            'data_scadenza' => 'nullable|date|after:data',
            'stato' => 'required|in:' . implode(',', [
                Fattura::STATO_BOZZA,
                Fattura::STATO_INVIATA,
                Fattura::STATO_PAGATA,
                Fattura::STATO_SCADUTA,
                Fattura::STATO_ANNULLATA
            ]),
            'importo_netto' => 'required|numeric|min:0',
            'percentuale_iva' => 'required|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'commessa_id' => 'nullable|exists:commesse,id',
            'preventivo_id' => 'nullable|exists:preventivi,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        // Calcolo automatico dell'IVA e del totale
        $fattura->fill($validated);
        $fattura->calcolaIva();

        $fattura->save();

        return redirect()->route('fatture.show', $fattura)
            ->with('success', 'Fattura aggiornata con successo.');
    }

    public function destroy($id)
    {
        $fattura = Fattura::find($id);
        
        if (!$fattura) {
            abort(404, 'Fattura non trovata');
        }
        
        $fattura->delete();

        return redirect()->route('fatture.index')
            ->with('success', 'Fattura eliminata con successo.');
    }

    public function byCustomer(Customer $customer)
    {
        $fatture = $customer->fatture()
            ->with(['commessa', 'preventivo', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('fatture.index', compact('fatture', 'customer'));
    }

    public function byCommessa(Commessa $commessa)
    {
        $fatture = $commessa->fatture()
            ->with(['customer', 'preventivo', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('fatture.index', compact('fatture', 'commessa'));
    }

    public function byPreventivo(Preventivo $preventivo)
    {
        $fatture = $preventivo->fatture()
            ->with(['customer', 'preventivo', 'project', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('fatture.index', compact('fatture', 'preventivo'));
    }

    public function generatePdf($id)
    {
        $fattura = Fattura::with(['customer', 'commessa', 'preventivo', 'project', 'righe', 'pagamenti'])->findOrFail($id);
        
        $pdf = Pdf::loadView('fatture.print', compact('fattura'));
        
        // Pulisce il numero rimuovendo caratteri non validi per i nomi file
        $numeroPulito = preg_replace('/[\/\\\:*?"<>|]/', '_', $fattura->numero);
        $filename = 'Fattura-' . $numeroPulito . '-' . date('Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}
