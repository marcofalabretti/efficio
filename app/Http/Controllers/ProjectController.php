<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::with(['customer', 'manager', 'creator']);

        // Filtri
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $projects = $query->latest()->paginate(12);
        $customers = Customer::orderBy('name')->get();
        $statuses = [
            Project::STATUS_ACTIVE => 'Attivo',
            Project::STATUS_COMPLETED => 'Completato',
            Project::STATUS_SUSPENDED => 'Sospeso',
            Project::STATUS_CANCELLED => 'Cancellato'
        ];
        $priorities = [
            Project::PRIORITY_LOW => 'Bassa',
            Project::PRIORITY_MEDIUM => 'Media',
            Project::PRIORITY_HIGH => 'Alta',
            Project::PRIORITY_CRITICAL => 'Critica'
        ];

        return view('projects.index', compact('projects', 'customers', 'statuses', 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        
        return view('projects.create', compact('customers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:' . Project::STATUS_ACTIVE . ',' . Project::STATUS_COMPLETED . ',' . Project::STATUS_SUSPENDED . ',' . Project::STATUS_CANCELLED],
            'priority' => ['required', 'string', 'in:' . Project::PRIORITY_LOW . ',' . Project::PRIORITY_MEDIUM . ',' . Project::PRIORITY_HIGH . ',' . Project::PRIORITY_CRITICAL],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'progress' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'manager_id' => ['nullable', 'exists:users,id'],
        ]);

        $data['created_by'] = Auth::id();
        $data['progress'] = $data['progress'] ?? 0;

        $project = Project::create($data);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Progetto creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['customer', 'manager', 'creator']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $customers = Customer::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        
        return view('projects.edit', compact('project', 'customers', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:' . Project::STATUS_ACTIVE . ',' . Project::STATUS_COMPLETED . ',' . Project::STATUS_SUSPENDED . ',' . Project::STATUS_CANCELLED],
            'priority' => ['required', 'string', 'in:' . Project::PRIORITY_LOW . ',' . Project::PRIORITY_MEDIUM . ',' . Project::PRIORITY_HIGH . ',' . Project::PRIORITY_CRITICAL],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'progress' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'manager_id' => ['nullable', 'exists:users,id'],
        ]);

        $project->update($data);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Progetto aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Progetto eliminato con successo.');
    }
}
