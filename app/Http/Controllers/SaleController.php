<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $categories = Product::active()->select('category')->distinct()->pluck('category');
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

            // Proses penjualan dengan transaction
            $sale = $service->createSale($request->items, $request->user());

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

    // Tampilkan detail transaksi
    public function show(Sale $sale)
    {
        // Hanya user yang membuat transaksi atau admin yang bisa lihat
        if (auth()->user()->id !== $sale->user_id && !auth()->user()->isAdmin()) {
            abort(403);
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

