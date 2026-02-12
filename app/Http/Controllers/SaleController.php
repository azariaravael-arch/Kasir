<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use Illuminate\Http\Request;
use PDF;

class SaleController extends Controller
{
    // Tampilkan POS/Kasir
    public function index()
    {
        $products = Product::active()->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('pos.index', compact('products', 'categories'));
    }

    // Live search produk (AJAX)
    public function search(Request $request)
    {
        $keyword = $request->get('q', '');

        $products = Product::search($keyword)
            ->active()
            ->select('id', 'name', 'sku', 'price', 'stock', 'image', 'category')
            ->limit(20)
            ->get();

        $products->transform(function ($p) {
            $p->image_url = $p->image ? asset('storage/' . $p->image) : null;
            return $p;
        });

        return response()->json($products);
    }

    // Simpan transaksi penjualan
    public function store(StoreSaleRequest $request, SaleService $service)
    {
        try {
            // Validasi stok sebelum proses
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                if (!$product || !$product->hasStock($item['qty'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok produk tidak cukup'
                    ], 422);
                }
            }

            // Ambil tax_percent dari request (default 10 jika tidak ada)
            $taxPercent = $request->input('tax_percent', 10);

            // Proses penjualan dengan transaction
            $sale = $service->createSale($request->items, $request->user(), 'completed', $taxPercent);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'sale_id' => $sale->id,
                'invoice' => $sale->invoice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hold transaksi penjualan
    public function hold(StoreSaleRequest $request, SaleService $service)
    {
        try {
            // Ambil tax_percent dari request (default 10 jika tidak ada)
            $taxPercent = $request->input('tax_percent', 10);

            // Proses hold tanpa validasi stok
            $sale = $service->createSale($request->items, $request->user(), 'held', $taxPercent);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil di-hold',
                'sale_id' => $sale->id,
                'invoice' => $sale->invoice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Tampilkan list order yang di-hold (AJAX)
    public function held()
    {
        $query = Sale::where('status', 'held');

        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->user()->id);
        }

        $sales = $query->orderBy('created_at', 'desc')->get(['id', 'invoice', 'total', 'user_id', 'created_at']);

        return response()->json($sales);
    }

    // Tampilkan halaman list held orders
    public function heldPage()
    {
        return view('pos.held');
    }

    // Resume held order: return items to frontend and remove held record
    public function resume(Sale $sale)
    {
        // Hanya user yang membuat transaksi atau admin yang bisa resume
        if (auth()->user()->id !== $sale->user_id && !auth()->user()->isAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($sale->status !== 'held') {
            return response()->json(['success' => false, 'message' => 'Sale is not held'], 422);
        }

        $sale->load('items.product');

        $items = [];
        foreach ($sale->items as $it) {
            $items[] = [
                'product_id' => $it->product_id,
                'name' => $it->product ? $it->product->name : 'Unknown',
                'price' => $it->price,
                'qty' => $it->qty,
                'stock' => $it->product ? $it->product->stock : 0
            ];
        }

        // Hapus sale dan sale items agar tidak duplikat saat checkout nanti
        try {
            \DB::transaction(function () use ($sale) {
                $sale->items()->delete();
                $sale->delete();
            });

            return response()->json(['success' => true, 'items' => $items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Tampilkan detail transaksi
    public function show(Sale $sale)
    {
        // Hanya user yang membuat transaksi atau admin yang bisa lihat
        if (auth()->user()->id !== $sale->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Hanya tampilkan transaksi yang completed
        if ($sale->status !== 'completed') {
            abort(404);
        }

        $sale->load('items.product', 'user');
        return view('pos.show', compact('sale'));
    }

    // Cetak/generate struk PDF
    public function receipt(Sale $sale)
    {
        // Hanya user yang membuat transaksi atau admin yang bisa print
        if (auth()->user()->id !== $sale->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $sale->load('items.product', 'user');

        // Jika installed barryvdh/laravel-dompdf
        // return PDF::loadView('pos.receipt', compact('sale'))
        //            ->download('struk-'.$sale->invoice.'.pdf');

        // Untuk saat ini return view
        return view('pos.receipt', compact('sale'));
    }
}

