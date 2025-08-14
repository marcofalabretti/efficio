<?php

namespace App\Http\Controllers;

use App\Models\Commessa;
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CommessaController extends Controller
{
    public function index()
    {
        $commesse = Commessa::with(['customer', 'project', 'responsabile'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('commesse.index', compact('commesse'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('commesse.create', compact('customers', 'projects', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'stato' => 'required|in:' . implode(',', [
                Commessa::STATO_ATTIVA,
                Commessa::STATO_COMPLETATA,
                Commessa::STATO_SOSPESA,
                Commessa::STATO_ANNULLATA
            ]),
            'data_inizio' => 'required|date',
            'data_fine_prevista' => 'nullable|date|after:data_inizio',
            'budget' => 'nullable|numeric|min:0',
            'ore_stimate' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'project_id' => 'nullable|exists:projects,id',
            'responsabile_id' => 'nullable|exists:users,id',
        ]);

        $validated['created_by'] = Auth::id();

        Commessa::create($validated);

        return redirect()->route('commesse.index')
            ->with('success', 'Commessa creata con successo.');
    }

    public function show($id)
    {
        // Debug: verifichiamo se possiamo trovare la commessa manualmente
        $commessa = Commessa::find($id);
        
        if (!$commessa) {
            abort(404, 'Commessa non trovata');
        }
        
        // dd([
        //     'commessa_id' => $commessa->id,
        //     'commessa_nome' => $commessa->nome,
        //     'commessa_class' => get_class($commessa),
        //     'commessa_exists' => $commessa->exists
        // ]);
        
        $commessa->load(['customer', 'project', 'responsabile', 'creator', 'preventivi', 'fatture']);
        return view('commesse.show', compact('commessa'));
    }

    public function edit($id)
    {
        $commessa = Commessa::find($id);
        
        if (!$commessa) {
            abort(404, 'Commessa non trovata');
        }
        $customers = Customer::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('commesse.edit', compact('commessa', 'customers', 'projects', 'users'));
    }

    public function update(Request $request, $id)
    {
        $commessa = Commessa::find($id);
        
        if (!$commessa) {
            abort(404, 'Commessa non trovata');
        }
        
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'stato' => 'required|in:' . implode(',', [
                Commessa::STATO_ATTIVA,
                Commessa::STATO_COMPLETATA,
                Commessa::STATO_SOSPESA,
                Commessa::STATO_ANNULLATA
            ]),
            'data_inizio' => 'required|date',
            'data_fine_prevista' => 'nullable|date|after:data_inizio',
            'data_fine_effettiva' => 'nullable|date|after:data_inizio',
            'budget' => 'nullable|numeric|min:0',
            'ore_stimate' => 'nullable|numeric|min:0',
            'ore_effettive' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'project_id' => 'nullable|exists:projects,id',
            'responsabile_id' => 'nullable|exists:users,id',
        ]);

        $commessa->update($validated);

        return redirect()->route('commesse.show', $commessa)
            ->with('success', 'Commessa aggiornata con successo.');
    }

    public function destroy($id)
    {
        $commessa = Commessa::find($id);
        
        if (!$commessa) {
            abort(404, 'Commessa non trovata');
        }
        
        $commessa->delete();

        return redirect()->route('commesse.index')
            ->with('success', 'Commessa eliminata con successo.');
    }

    public function byCustomer(Customer $customer)
    {
        $commesse = $customer->commesse()
            ->with(['project', 'responsabile'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            // dd($commesse);
        return view('commesse.index', compact('commesse', 'customer'));
    }

    public function generatePdf($id)
    {
        $commessa = Commessa::with(['customer', 'project.manager', 'responsabile'])->findOrFail($id);
        
        $pdf = Pdf::loadView('commesse.print', compact('commessa'));
        
        // Pulisce il codice rimuovendo caratteri non validi per i nomi file
        $codicePulito = preg_replace('/[\/\\\:*?"<>|]/', '_', $commessa->codice);
        $filename = 'Commessa-' . $codicePulito . '-' . date('Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}
