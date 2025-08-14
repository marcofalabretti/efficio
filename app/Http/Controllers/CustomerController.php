<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('vat_number', 'like', "%{$search}%")
                      ->orWhere('fiscal_code', 'like', "%{$search}%")
                      ->orWhere('street', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%")
                      ->orWhere('zip', 'like', "%{$search}%")
                      ->orWhere('country', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();
            
        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:50'],
            'vat_number' => ['nullable','string','max:50'],
            'fiscal_code' => ['nullable','string','max:50'],
            'street' => ['nullable','string','max:255'],
            'city' => ['nullable','string','max:100'],
            'zip' => ['nullable','string','max:20'],
            'country' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],
        ]);
        $customer = Customer::create($data);
        return redirect()->route('customers.show', $customer)->with('success', 'Cliente creato.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['commesse', 'preventivi', 'fatture']);
        $paymentStats = $customer->getPaymentStats();
        
        return view('customers.show', compact('customer', 'paymentStats'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:50'],
            'vat_number' => ['nullable','string','max:50'],
            'fiscal_code' => ['nullable','string','max:50'],
            'street' => ['nullable','string','max:255'],
            'city' => ['nullable','string','max:100'],
            'zip' => ['nullable','string','max:20'],
            'country' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],
        ]);
        $customer->update($data);
        return redirect()->route('customers.show', $customer)->with('success', 'Cliente aggiornato.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminato.');
    }
}


