<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display list of purchases
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['supplier', 'user', 'items']);

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by date range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->betweenDates($request->from_date, $request->to_date);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('purchase_number', 'like', "%{$search}%")
                ->orWhereHas('supplier', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $purchases = $query->orderByDesc('created_at')->paginate(15);

        return view('purchases.index', [
            'purchases' => $purchases,
            'statuses' => ['draft' => 'Draft', 'pending' => 'Pending', 'received' => 'Diterima', 'cancelled' => 'Dibatalkan']
        ]);
    }

    /**
     * Show form for creating new purchase
     */
    public function create()
    {
        $suppliers = Supplier::active()->get();
        $products = Product::all();

        return view('purchases.create', [
            'suppliers' => $suppliers,
            'products' => $products
        ]);
    }

    /**
     * Store new purchase
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:draft,pending,received'
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;

            // Create purchase
            $purchase = Purchase::create([
                'supplier_id' => $validated['supplier_id'],
                'user_id' => auth()->id(),
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null
            ]);

            // Create purchase items
            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $totalAmount += $subtotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal
                ]);
            }

            // Update total amount
            $purchase->update(['total_amount' => $totalAmount]);

            // If purchase created with status 'received', increment product stocks
            if ($purchase->status === 'received') {
                foreach ($purchase->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                    }
                }
                $purchase->update(['received_date' => now()]);
            }

            DB::commit();

            return redirect()->route('purchases.show', $purchase)
                ->with('success', "Pembelian {$purchase->purchase_number} berhasil dibuat");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show purchase details
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'items.product']);

        return view('purchases.show', ['purchase' => $purchase]);
    }

    /**
     * Show form for editing purchase
     */
    public function edit(Purchase $purchase)
    {
        // Only allow edit if status is draft
        if ($purchase->status !== 'draft') {
            return back()->with('error', 'Hanya dapat mengedit pembelian dengan status draft');
        }

        $suppliers = Supplier::active()->get();
        $products = Product::all();
        $purchase->load('items');

        return view('purchases.edit', [
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'products' => $products
        ]);
    }

    /**
     * Update purchase
     */
    public function update(Request $request, Purchase $purchase)
    {
        if ($purchase->status !== 'draft') {
            return back()->with('error', 'Hanya dapat mengedit pembelian dengan status draft');
        }

        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:draft,pending,received'
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;

            // Update purchase header
            $purchase->update([
                'supplier_id' => $validated['supplier_id'],
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status']
            ]);

            // Delete existing items
            $purchase->items()->delete();

            // Create new items
            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $totalAmount += $subtotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal
                ]);
            }

            // Update total amount
            $purchase->update(['total_amount' => $totalAmount]);

            // If status changed to 'received' during update, increment stock
            if ($purchase->status === 'received') {
                foreach ($purchase->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                    }
                }
                $purchase->update(['received_date' => now()]);
            }

            DB::commit();

            return redirect()->route('purchases.show', $purchase)
                ->with('success', "Pembelian {$purchase->purchase_number} berhasil diperbarui");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Receive purchase (update stock)
     */
    public function receive(Request $request, Purchase $purchase)
    {
        if ($purchase->status === 'received') {
            return back()->with('error', 'Pembelian sudah diterima sebelumnya');
        }

        if ($purchase->status === 'draft') {
            return back()->with('error', 'Harap ubah status ke Pending terlebih dahulu');
        }

        DB::beginTransaction();
        try {
            $purchase->markAsReceived();

            DB::commit();

            return back()->with('success', 'Pembelian berhasil diterima dan stok diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Cancel purchase
     */
    public function cancel(Request $request, Purchase $purchase)
    {
        if ($purchase->status === 'received') {
            return back()->with('error', 'Tidak dapat membatalkan pembelian yang sudah diterima');
        }

        $purchase->update(['status' => 'cancelled']);

        return back()->with('success', 'Pembelian berhasil dibatalkan');
    }

    /**
     * Delete purchase (only draft)
     */
    public function destroy(Purchase $purchase)
    {
        if ($purchase->status !== 'draft') {
            return back()->with('error', 'Hanya dapat menghapus pembelian dengan status draft');
        }

        $purchase->items()->delete();
        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian berhasil dihapus');
    }

    /**
     * Search products for live search
     */
    public function searchProducts(Request $request)
    {
        $products = Product::search($request->q)->select('id', 'name', 'sku', 'price')->take(10)->get();

        return response()->json($products);
    }

    /**
     * Get product detail
     */
    public function getProduct(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'price' => $product->price,
            'stock' => $product->stock
        ]);
    }
}
