<?php

namespace App\Http\Controllers;

use App\Models\ProductReturn;
use App\Models\ReturnItem;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    /**
     * Display a listing of returns
     */
    public function index(Request $request)
    {
        $query = ProductReturn::with(['purchase', 'supplier', 'user']);

        // Filter by status
        if ($request->status && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->from_date && $request->to_date) {
            $query->whereDate('created_at', '>=', $request->from_date)
                  ->whereDate('created_at', '<=', $request->to_date);
        }

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('return_number', 'like', '%' . $request->search . '%')
                  ->orWhere('reason', 'like', '%' . $request->search . '%');
            });
        }

        $returns = $query->latest()->paginate(15);

        return view('returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new return
     */
    public function create()
    {
        $purchases = Purchase::where('status', 'received')
            ->with('supplier', 'items')
            ->latest()
            ->get();

        return view('returns.create', compact('purchases'));
    }

    /**
     * Store a newly created return in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.purchase_item_id' => 'required|exists:purchase_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.reason' => 'required|string|max:255',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $purchase = Purchase::find($validated['purchase_id']);
            
            // Create return
            $return = ProductReturn::create([
                'purchase_id' => $purchase->id,
                'supplier_id' => $purchase->supplier_id,
                'user_id' => auth()->id(),
                'reason' => $validated['reason'] ?? 'Retur Barang',
                'status' => 'draft',
                'total_amount' => 0,
                'notes' => $validated['notes'] ?? null
            ]);

            // Create return items and calculate total
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                
                ReturnItem::create([
                    'return_id' => $return->id,
                    'product_id' => $item['product_id'],
                    'purchase_item_id' => $item['purchase_item_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                    'reason' => $item['reason']
                ]);

                $totalAmount += $subtotal;
            }

            $return->update(['total_amount' => $totalAmount]);

            DB::commit();

            return redirect()
                ->route('returns.show', $return)
                ->with('success', 'Retur berhasil dibuat dengan nomor: ' . $return->return_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat retur: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified return
     */
    public function show(ProductReturn $return)
    {
        $return->load(['purchase', 'supplier', 'user', 'items.product']);
        return view('returns.show', compact('return'));
    }

    /**
     * Show the form for editing the specified return
     */
    public function edit(ProductReturn $return)
    {
        if ($return->status !== 'draft') {
            return back()->with('error', 'Hanya retur dengan status draft yang bisa diubah');
        }

        $return->load(['purchase.items.product', 'items']);
        $purchases = Purchase::where('status', 'received')->get();

        return view('returns.edit', compact('return', 'purchases'));
    }

    /**
     * Update the specified return in storage
     */
    public function update(Request $request, ProductReturn $return)
    {
        if ($return->status !== 'draft') {
            return back()->with('error', 'Hanya retur dengan status draft yang bisa diubah');
        }

        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.purchase_item_id' => 'required|exists:purchase_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.reason' => 'required|string|max:255',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            // Hapus return items yang lama
            ReturnItem::where('return_id', $return->id)->delete();

            // Buat return items yang baru
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                
                ReturnItem::create([
                    'return_id' => $return->id,
                    'product_id' => $item['product_id'],
                    'purchase_item_id' => $item['purchase_item_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                    'reason' => $item['reason']
                ]);

                $totalAmount += $subtotal;
            }

            // Update return
            $return->update([
                'total_amount' => $totalAmount,
                'reason' => $validated['reason'] ?? 'Retur Barang',
                'notes' => $validated['notes'] ?? null
            ]);

            DB::commit();

            return redirect()
                ->route('returns.show', $return)
                ->with('success', 'Retur berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengubah retur: ' . $e->getMessage());
        }
    }

    /**
     * Approve the specified return
     */
    public function approve(ProductReturn $return)
    {
        if ($return->status !== 'draft') {
            return back()->with('error', 'Hanya retur dengan status draft yang bisa disetujui');
        }

        try {
            DB::beginTransaction();

            // Update return status
            $return->update([
                'status' => 'approved',
                'return_date' => now()
            ]);

            // Kurangi stok produk
            foreach ($return->items as $item) {
                $product = $item->product;
                $product->decrement('stock', $item->quantity);
            }

            DB::commit();

            return redirect()
                ->route('returns.show', $return)
                ->with('success', 'Retur berhasil disetujui dan stok sudah dikurangi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui retur: ' . $e->getMessage());
        }
    }

    /**
     * Reject the specified return
     */
    public function reject(ProductReturn $return)
    {
        if ($return->status !== 'draft') {
            return back()->with('error', 'Hanya retur dengan status draft yang bisa ditolak');
        }

        $return->update(['status' => 'rejected']);

        return redirect()
            ->route('returns.index')
            ->with('success', 'Retur berhasil ditolak');
    }

    /**
     * Delete the specified return
     */
    public function destroy(ProductReturn $return)
    {
        if ($return->status !== 'draft') {
            return back()->with('error', 'Hanya retur dengan status draft yang bisa dihapus');
        }

        $return->delete();

        return redirect()
            ->route('returns.index')
            ->with('success', 'Retur berhasil dihapus');
    }

    /**
     * Get purchase items for selected purchase
     */
    public function getPurchaseItems($purchaseId)
    {
        $items = PurchaseItem::where('purchase_id', $purchaseId)
            ->with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity_purchased' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'category' => $item->product->category,
                ];
            });

        return response()->json($items);
    }
}
