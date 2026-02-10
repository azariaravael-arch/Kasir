<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display list of suppliers
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Filter status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $suppliers = $query->orderBy('name')->paginate(20);

        return view('suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show form for creating new supplier
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store new supplier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        // Convert checkbox to boolean
        $validated['is_active'] = $request->has('is_active') ? true : false;

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Show supplier details
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', ['supplier' => $supplier]);
    }

    /**
     * Show form for editing supplier
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    /**
     * Update supplier
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        // Convert checkbox to boolean
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $supplier->update($validated);

        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier berhasil diperbarui');
    }

    /**
     * Delete supplier
     */
    public function destroy(Supplier $supplier)
    {
        // Check if supplier has purchases
        if ($supplier->purchases()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus supplier yang memiliki riwayat pembelian');
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
