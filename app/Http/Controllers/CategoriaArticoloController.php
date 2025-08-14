<?php

namespace App\Http\Controllers;

use App\Models\CategoriaArticolo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriaArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categorie = CategoriaArticolo::with('sottocategorie')
            ->principali()
            ->ordinate()
            ->get();

        return view('categorie-articoli.index', compact('categorie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categoriePrincipali = CategoriaArticolo::principali()->ordinate()->get();
        
        return view('categorie-articoli.create', compact('categoriePrincipali'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:categorie_articoli',
            'codice' => 'required|string|max:20|unique:categorie_articoli',
            'descrizione' => 'nullable|string',
            'colore' => 'nullable|string|max:7',
            'categoria_padre_id' => 'nullable|exists:categorie_articoli,id',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        CategoriaArticolo::create($request->all());

        return redirect()->route('categorie-articoli.index')
            ->with('success', 'Categoria creata con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaArticolo $categoriaArticolo): View
    {
        $categoriaArticolo->load(['sottocategorie', 'articoli']);
        
        return view('categorie-articoli.show', compact('categoriaArticolo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaArticolo $categoriaArticolo): View
    {
        $categoriePrincipali = CategoriaArticolo::principali()
            ->where('id', '!=', $categoriaArticolo->id)
            ->ordinate()
            ->get();
        
        return view('categorie-articoli.edit', compact('categoriaArticolo', 'categoriePrincipali'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaArticolo $categoriaArticolo): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:categorie_articoli,nome,' . $categoriaArticolo->id,
            'codice' => 'required|string|max:20|unique:categorie_articoli,codice,' . $categoriaArticolo->id,
            'descrizione' => 'nullable|string',
            'colore' => 'nullable|string|max:7',
            'categoria_padre_id' => 'nullable|exists:categorie_articoli,id',
            'ordinamento' => 'nullable|integer|min:0',
        ]);

        $categoriaArticolo->update($request->all());

        return redirect()->route('categorie-articoli.index')
            ->with('success', 'Categoria aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaArticolo $categoriaArticolo): RedirectResponse
    {
        // Verifica se ci sono articoli associati
        if ($categoriaArticolo->articoli()->count() > 0) {
            return redirect()->route('categorie-articoli.index')
                ->with('error', 'Impossibile eliminare la categoria: ci sono articoli associati.');
        }

        // Verifica se ci sono sottocategorie
        if ($categoriaArticolo->sottocategorie()->count() > 0) {
            return redirect()->route('categorie-articoli.index')
                ->with('error', 'Impossibile eliminare la categoria: ci sono sottocategorie associate.');
        }

        $categoriaArticolo->delete();

        return redirect()->route('categorie-articoli.index')
            ->with('success', 'Categoria eliminata con successo.');
    }

    /**
     * Toggle dello stato attivo/inattivo
     */
    public function toggleStato(CategoriaArticolo $categoriaArticolo): RedirectResponse
    {
        $categoriaArticolo->update(['attiva' => !$categoriaArticolo->attiva]);

        $stato = $categoriaArticolo->attiva ? 'attivata' : 'disattivata';
        
        return redirect()->route('categorie-articoli.index')
            ->with('success', "Categoria {$stato} con successo.");
    }

    /**
     * API per ottenere le categorie in formato JSON
     */
    public function apiIndex()
    {
        $categorie = CategoriaArticolo::attive()
            ->with('sottocategorie')
            ->principali()
            ->ordinate()
            ->get();

        return response()->json($categorie);
    }
}
